<?php

namespace App\Http\Controllers;
use App\Models\Reservation; // Assurez-vous d'avoir un modèle Reservation
use App\Models\Passenger;
use Illuminate\Support\Facades\Validator; // Pour la validation
use App\Models\Flight;
use Illuminate\Support\Facades\DB; 
use App\Models\Airport;
use Illuminate\Http\Request; // Important: Importer Request
use Carbon\Carbon; // Importer Carbon pour la manipulation des dates si nécessaire
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function showBooking(Request $request) // Injecter Request
    {
        // Récupérer les paramètres de la requête GET
        $departureAirportId = $request->input('departure');
        $arrivalAirportId = $request->input('arrival');
        $departureDate = $request->input('date');

        // Commencer une requête Eloquent sur le modèle Flight
        $query = Flight::query();

        // Appliquer les filtres si les paramètres sont présents
        if ($departureAirportId) {
            // Assure-toi que le nom de la colonne est correct (ex: departure_airport_id)
            $query->where('departure_airport_id', $departureAirportId); 
        }

        if ($arrivalAirportId) {
            // Assure-toi que le nom de la colonne est correct (ex: arrival_airport_id)
            $query->where('arrival_airport_id', $arrivalAirportId);
        }

        if ($departureDate) {
            // Filtrer par la *date* de départ. 
            // Assure-toi que 'departure_time' est le nom correct de ta colonne DATETIME/TIMESTAMP/DATE
            // whereDate compare uniquement la partie date
            $query->whereDate('departure_time', $departureDate); 
        }

        // Exécuter la requête pour obtenir les vols filtrés
        // Eager load les relations pour éviter le problème N+1 query
        // Adapte les noms des relations ('departureAirport', 'arrivalAirport') à ceux définis dans ton modèle Flight
        $flights = $query->with(['departureAirport', 'arrivalAirport'/*, 'airline' si tu as cette relation */])->get(); 

        // Récupérer tous les aéroports pour les dropdowns (comme avant)
        $airports = Airport::all(); 
        
        // Récupérer les avions n'est probablement pas nécessaire ici, sauf si tu les affiches
        // $planes = Plane::all(); 

        // Retourner la vue avec les aéroports et les vols (filtrés ou tous)
        // Retire 'planes' si non utilisé
        return view('bookingAirplane', compact('airports', 'flights')); 
    }


    
    // Méthode pour traiter la soumission du formulaire unique
    public function storeReservation(Request $request)
    {
        // --- 1. Validation ---
        $totalPassengers = (int) $request->input('adults', 0) + (int) $request->input('children', 0);

        // Règles de validation de base
        $rules = [
            'flight_id' => 'required|integer|exists:flights,id',
            'date' => 'required|date_format:Y-m-d', // Ajustez si le format est différent
            'class' => 'required|string|in:economy,business,first', // Ajustez les classes possibles
            'adults' => 'required|integer|min:1', // Au moins un adulte requis ? Adaptez si besoin.
            'children' => 'required|integer|min:0',
            'passengers' => 'required|array|size:' . $totalPassengers, // Doit y avoir exactement le bon nombre de passagers
            // Validation pour chaque élément du tableau passengers
            'passengers.*.firstname' => 'required|string|max:100',
            'passengers.*.lastname' => 'required|string|max:100',
            'passengers.*.gender' => 'required|string|in:male,female', // Adaptez si 'other' est possible
            'passengers.*.age' => 'required|integer|min:0|max:120',
        ];

        // Messages d'erreur personnalisés (optionnel, mais recommandé en français)
        $messages = [
            'passengers.required' => 'Les informations des passagers sont requises.',
            'passengers.size' => 'Le nombre de formulaires passagers soumis ne correspond pas au nombre de voyageurs indiqué.',
            'passengers.*.firstname.required' => 'Le prénom du passager :position est requis.',
            'passengers.*.lastname.required' => 'Le nom du passager :position est requis.',
            'passengers.*.gender.required' => 'Le sexe du passager :position est requis.',
            'passengers.*.gender.in' => 'La valeur pour le sexe du passager :position est invalide.',
            'passengers.*.age.required' => 'L\'âge du passager :position est requis.',
            'passengers.*.age.integer' => 'L\'âge du passager :position doit être un nombre.',
            'passengers.*.age.min' => 'L\'âge du passager :position ne peut pas être négatif.',
            // Ajoutez d'autres messages si nécessaire
        ];

        // Exécutez la validation
        $validator = Validator::make($request->all(), $rules, $messages);

        // Si la validation échoue, redirigez vers le formulaire avec les erreurs et les anciennes entrées
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput(); // Important pour remplir les champs avec old()
        }

        // Récupération des données validées (inclut le tableau 'passengers')
        $validatedData = $validator->validated();

        // --- 2. Traitement (Création Réservation et Passagers) ---
        DB::beginTransaction(); // Commence une transaction

        try {
            // Créez la réservation principale
            $reservation = new Reservation();
            $reservation->flight_id = $validatedData['flight_id'];
            $reservation->user_id = auth()->id(); // Assurez-vous que l'utilisateur est connecté
            $reservation->reservation_date = now();
            $reservation->booking_reference = strtoupper(uniqid('AIRB')); // Génère une référence unique simple
            $reservation->status = 'confirmed'; // Ou 'pending', 'paid', etc.
            $reservation->total_passengers = $totalPassengers;
            $reservation->flight_class = $validatedData['class'];
            $reservation->departure_date = $validatedData['date']; // Stocker la date du vol demandée
            // Ajoutez d'autres champs si nécessaire (prix total, etc.)
            $reservation->save();

            // Créez chaque passager et liez-le à la réservation
            foreach ($validatedData['passengers'] as $passengerData) {
                $passenger = new Passenger();
                $passenger->reservation_id = $reservation->id; // Clé étrangère vers la réservation
                $passenger->first_name = $passengerData['firstname'];
                $passenger->last_name = $passengerData['lastname'];
                $passenger->gender = $passengerData['gender'];
                $passenger->age = $passengerData['age'];
                // Ajoutez d'autres champs si nécessaire (numéro de passeport, etc.)
                $passenger->save();
            }

            DB::commit(); // Tout s'est bien passé, on valide la transaction

            // --- 3. Redirection après succès ---
            // Redirigez vers une page de confirmation avec un message de succès
            return redirect()->route('booking.confirmation', ['reference' => $reservation->booking_reference]) // Créez cette route et vue
                         ->with('success', 'Votre réservation a été effectuée avec succès ! Votre référence : ' . $reservation->booking_reference);

        } catch (\Exception $e) {
            DB::rollBack(); // Annule la transaction en cas d'erreur

            // Logguez l'erreur pour le débogage
            Log::error('Erreur lors de la création de la réservation: ' . $e->getMessage());

            // Redirigez vers le formulaire avec un message d'erreur général
            return redirect()->back()
                        ->with('error', 'Une erreur est survenue lors de la réservation. Veuillez réessayer.')
                        ->withInput();
        }
    }

     // Méthode pour afficher la confirmation (exemple)
     public function showConfirmation(Request $request, $reference)
     {
         $reservation = Reservation::where('booking_reference', $reference)->with('passengers', 'flight.departureAirport', 'flight.arrivalAirport')->firstOrFail();
         // Assurez-vous que l'utilisateur actuel a le droit de voir cette réservation
         // if ($reservation->user_id !== auth()->id()) { abort(403); }

         return view('booking.confirmation', compact('reservation')); // Créez cette vue
     }
}