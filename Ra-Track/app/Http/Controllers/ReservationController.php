<?php

namespace App\Http\Controllers;
use App\Models\Flight;
use App\Models\Reservation;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB; // Pour les transactions
use Illuminate\Support\Facades\Validator; // Pour la validation
use Illuminate\Support\Facades\Log;


class ReservationController extends Controller
{
   
    public function showConfirmation(Reservation $reservation)
    {
        // 1. Vérifier l'autorisation : L'utilisateur connecté doit être le propriétaire de la réservation
        if (!Auth::check() || $reservation->user_id !== Auth::id()) {
            // Optionnel : Autoriser un admin si tu as un système de rôles
            // if (!Auth::user()?->isAdmin()) {
                Log::warning("Accès non autorisé à la confirmation. User: " . Auth::id() . ", Resa User: {$reservation->user_id}, Resa ID: {$reservation->id}");
                abort(403, 'Accès non autorisé à cette confirmation de réservation.');
            // }
        }

        // 2. Charger les relations nécessaires pour la vue de confirmation
        //    (Normalement déjà chargées par le contrôleur de paiement avant la redirection,
        //     mais le recharger ici garantit que les données sont fraîches et disponibles)
        $reservation->loadMissing([
            'passengers', // Essentiel pour lister les passagers et liens billets
            'flight.departureAirport', // Pour afficher les détails du vol
            'flight.arrivalAirport',   // Pour afficher les détails du vol
            'user' // Au cas où tu affiches des infos utilisateur sur la confirmation
        ]);

        // 3. Retourner la vue de confirmation avec les données de la réservation
        return view('reservation.confirmation', compact('reservation'));
    }

    public function show($id)
    {
        $flight = Flight::with(['departureAirport', 'arrivalAirport'])->findOrFail($id);
        return view('reservation.show', compact('flight'));
    }



    public function index(Request $request)
    {
    
        $reservations = Reservation::with(['user', 'flight', 'passengers'])->get(); // Eager load relationships

        return response()->json([
            'status' => 'success',
            'data' => $reservations
        ]);
    }

    

    public function store(Request $request)
    {
        $totalPassengers = (int) $request->input('adults', 0) + (int) $request->input('children', 0);
        $validator = Validator::make($request->all(), [
            'flight_id' => 'required|integer|exists:flights,id',
            'date'      => 'required|date_format:Y-m-d', // Ajustez le format si nécessaire
            'class'     => 'required|string|in:economy,business,first', // Ajustez les classes
            'adults'    => 'required|integer|min:1', // Au moins 1 adulte requis ?
            'children'  => 'required|integer|min:0',
            'passengers' => 'required|array|size:' . $totalPassengers,
            'passengers.*.firstname' => 'required|string|max:100',
            'passengers.*.lastname'  => 'required|string|max:100',
            'passengers.*.gender'    => 'required|string|in:male,female',
            'passengers.*.age'       => 'required|integer|min:0|max:120',
        ],[
            'passengers.size' => 'Le nombre de passagers fournis ne correspond pas au nombre de voyageurs indiqués.',
            'passengers.*.firstname.required' => 'Le prénom du passager :position est requis.',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput(); // Retour au formulaire avec les erreurs
        }
        // Récupérer les données validées (bonne pratique)
        $validatedData = $validator->validated();

        // --- 2. Création en Base de Données (avec Transaction) ---
        $reservation = null; // Initialiser pour la portée

        DB::beginTransaction(); // Démarre une transaction pour assurer l'atomicité

        try {
            // Créez la réservation principale
            $reservation = Reservation::create([
                'user_id'   => Auth::check() ? Auth::id() : null, // Gère connecté vs. invité
                'flight_id' => $validatedData['flight_id'],
                // Assurez-vous que votre modèle Reservation a bien ces champs fillable
                'date'      => $validatedData['date'], // Ou le nom exact du champ (ex: departure_date)
                'class'     => $validatedData['class'], // Ou flight_class
                'adults'    => $validatedData['adults'],
                'children'  => $validatedData['children'],
                'status'    => 'pending_authentication', // Statut initial pourrait être utile
                'booking_reference' => strtoupper(uniqid('AIRB')), // Générer une référence
                // Ajoutez d'autres champs nécessaires (prix total, etc.)
            ]);

            // Enregistrez les passagers associés
            foreach ($validatedData['passengers'] as $passengerData) {
                // Assurez-vous que Passenger a reservation_id fillable
                Passenger::create([
                    'reservation_id' => $reservation->id, // Utilise l'ID de la réservation créée juste avant
                    'firstname' => $passengerData['firstname'],
                    'lastname'  => $passengerData['lastname'],
                    'gender'    => $passengerData['gender'],
                    'age'       => $passengerData['age'],
                ]);
            }

            DB::commit(); // Tout s'est bien passé, on enregistre les changements

        } catch (\Exception $e) {
            DB::rollBack(); // Une erreur est survenue, on annule tout ce qui a été fait dans la transaction

            // Log l'erreur pour le débogage
            Log::error("Erreur lors de la création de la réservation et/ou des passagers: " . $e->getMessage());

            // Rediriger l'utilisateur vers le formulaire avec une erreur générique
            return redirect()->back()
                        ->with('error', 'Une erreur technique est survenue lors de l\'enregistrement. Veuillez réessayer.')
                        ->withInput(); // Garde les anciennes entrées
        }


        // --- 3. Redirection basée sur l'authentification ---
        if (!Auth::check()) {
            session(['pending_reservation_id' => $reservation->id]);
        
            return redirect()->route('login')
                   ->with('info', 'Veuillez vous connecter pour continuer vers le paiement.');
        } else {
            return redirect()->route('payments.index', ['reservation' => $reservation->id]);
        }
    }

    

    
  
    public function update(Request $request, Reservation $reservation)
    {
        // Optionnel : Vérifier si l'utilisateur a le droit de modifier cette réservation
        // if (Auth::id() !== $reservation->user_id /* && !Auth::user()->isAdmin() */ ) {
        //     return response()->json(['status' => 'error', 'message' => 'Action non autorisée.'], 403); // Forbidden
        // }

        $validated = $request->validate([
            // Seuls les champs modifiables doivent être validés ici
            // 'flight_id' => 'sometimes|required|exists:flights,id', // Permettre de changer le vol ? Risqué.
            'class' => ['sometimes', 'required', Rule::in(['economy', 'business', 'first'])],
        ]);

        try {
            $reservation->update($validated);

            // Recharger les relations pour les inclure dans la réponse
             $reservation->load(['user', 'flight', 'passengers']);

            return response()->json([
                'status' => 'success',
                'message' => 'Réservation mise à jour avec succès.',
                'data' => $reservation
            ]);

        } catch (\Exception $e) {
            // Log::error("Erreur mise à jour réservation: " . $e->getMessage()); // Optionnel: log l'erreur
             return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la mise à jour de la réservation.',
                'error_details' => $e->getMessage() // Fournir des détails en développement
             ], 500); // Internal Server Error
        }
    }

   
    public function destroy(Reservation $reservation)
    {
        // Optionnel : Vérifier si l'utilisateur a le droit de supprimer cette réservation
        // if (Auth::id() !== $reservation->user_id /* && !Auth::user()->isAdmin() */ ) {
        //     return response()->json(['status' => 'error', 'message' => 'Action non autorisée.'], 403); // Forbidden
        // }

        try {
            // Si onDelete('cascade') n'est pas défini pour reservation_id dans la migration passengers,
            // il faudrait supprimer les passagers manuellement avant :
            // $reservation->passengers()->delete();

            $reservation->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Réservation supprimée avec succès.'
            ]); // Ou retourner response()->json(null, 204) pour No Content

        } catch (\Exception $e) {
             // Log::error("Erreur suppression réservation: " . $e->getMessage()); // Optionnel: log l'erreur
             return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de la suppression de la réservation.',
                'error_details' => $e->getMessage() // Fournir des détails en développement
             ], 500); // Internal Server Error
        }
    }
}

