<?php

namespace App\Http\Controllers;

// ... autres use statements ...
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth; // Assure-toi qu'il est importé
use Stripe\Stripe; // Ajouts pour Stripe
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Illuminate\Http\Request; // Pour la méthode success
use Illuminate\Support\Facades\Log; // Pour logger
use App\Models\Payment; // Pour la méthode success


class PaymentController extends Controller
{
    /**
     * Affiche la page de confirmation/paiement pour une réservation.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index(Reservation $reservation)
    {
        // Vérifie que la réservation appartient à l'utilisateur connecté
        // C'est une bonne pratique de sécurité
        if ($reservation->user_id !== Auth::id()) {
             // Si tu as un système d'admin, tu pourrais ajouter une condition ici
             // if (!Auth::user()->isAdmin()) { ... }
            abort(403, 'Accès non autorisé à cette réservation.');
        }

        // Charge les passagers et le vol avec eager loading (déjà bien fait)
        // C'est important pour que les méthodes du modèle fonctionnent sans requêtes N+1
        $reservation->load('passengers', 'flight');

        // Vérification supplémentaire : le vol a-t-il des prix définis ?
        if (!$reservation->flight || $reservation->getBasePriceForClass() === null) {
             Log::error("Les informations de prix pour le vol ID {$reservation->flight_id} (classe {$reservation->class}) sont manquantes ou invalides.");
             // Redirige avec une erreur ou affiche un message spécifique dans la vue
             return redirect()->route('dashboard')->with('error', 'Impossible d\'afficher les détails de paiement car les informations de prix du vol sont manquantes.');
        }

        // Passe simplement la réservation à la vue.
        // Les calculs se feront via les méthodes du modèle dans la vue.
        return view('payments', compact('reservation')); // Assure-toi que le nom de la vue est correct
    }

    // ... méthodes checkout, success, cancel (précédemment ajoutées) ...
     /**
     * Crée une session Stripe Checkout et redirige l'utilisateur.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkout(Reservation $reservation)
    {
        // 1. Récupérer le montant total à payer depuis la réservation
        // Utilise la méthode du modèle maintenant !
        $totalPrice = $reservation->calculateTotalPrice();

        if ($totalPrice === null || $totalPrice <= 0) {
            Log::error("Tentative de checkout avec un prix invalide ou nul pour la réservation ID: {$reservation->id}");
            return redirect()->back()->with('error', 'Impossible de déterminer le montant à payer. Veuillez contacter le support.');
        }

        // Stripe attend le montant en centimes
        $amountInCents = (int) round($totalPrice * 100); // Utilise round() pour éviter les pbs flottants
        $currency = 'eur'; // Ou la devise appropriée (ex: 'usd')

        // 2. Configurer Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // 3. Créer la Session Checkout Stripe
            $checkout_session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => $currency,
                        'product_data' => [
                            'name' => 'Réservation Vol ' . optional($reservation->flight)->flight_number, // Utilise le numéro de vol si dispo
                            'description' => 'Référence: ' . $reservation->booking_reference . ' (' . $reservation->passengers->count() . ' passagers)',
                        ],
                        'unit_amount' => $amountInCents, // Le montant total calculé
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                // Utilise l'ID de réservation numérique ici pour les routes success/cancel
                'success_url' => route('payment.success', ['id' => $reservation->id]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel', ['reservation_id' => $reservation->id]), // Peut être utile d'avoir l'ID ici aussi
                'metadata' => [
                    'reservation_id' => $reservation->id,
                    'booking_reference' => $reservation->booking_reference,
                ],
                 'customer_email' => optional($reservation->user)->email, // Pré-remplir si l'utilisateur est lié
            ]);

            // 4. Rediriger vers Stripe
            return redirect($checkout_session->url, 303);

        } catch (ApiErrorException $e) {
            Log::error("Erreur API Stripe Checkout pour réservation {$reservation->id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur de communication avec le service de paiement. Veuillez réessayer.');
        } catch (\Exception $e) {
            Log::error("Erreur interne lors de la redirection Stripe pour réservation {$reservation->id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur inattendue est survenue. Veuillez réessayer.');
        }
    }

      /**
     * Gère la redirection après un paiement réussi.
     */
    public function success(Request $request, $reservationId)
    {
        $reservation = Reservation::find($reservationId);

        if (!$reservation) {
             Log::error("Réservation ID {$reservationId} non trouvée lors du retour de succès Stripe.");
             return redirect()->route('home')->with('error', 'Réservation non trouvée.');
        }

        $stripeSessionId = $request->query('session_id');

        if (!$stripeSessionId) {
             Log::warning("ID de session Stripe manquant pour réservation ID {$reservationId}.");
             return redirect()->route('payments.index', ['reservation' => $reservation->id])->with('error', 'Information de paiement manquante.');
        }

        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $session = Session::retrieve($stripeSessionId);
            Log::debug('Stripe Session Retrieved:', ['session_id' => $stripeSessionId, 'status' => $session->payment_status, 'metadata' => $session->metadata]);

            // Vérification CRUCIALE
            if ($session->metadata->reservation_id == $reservation->id && $session->payment_status == 'paid') {

                Log::info("Condition IF succès REMPLIE pour résa {$reservation->id}.");

                // Vérifier si un paiement existe déjà pour cette transaction (évite doublons)
                 $existingPayment = Payment::where('transaction_id', $session->payment_intent)->first();
                 if ($existingPayment) {
                     Log::info("Paiement déjà existant trouvé pour résa {$reservation->id}.");
                     // Le paiement est déjà traité, on redirige vers le dashboard.
                     return redirect()->route('dashboard')
                        ->with('success', 'Votre réservation est déjà confirmée.'); // Message légèrement ajusté
                 }
                Log::info("Tentative de création de l'enregistrement Payment pour réservation {$reservation->id}.");
                try {
                    $payment = Payment::create([
                        'reservation_id' => $reservation->id,
                        'payment_method' => 'credit_card', // Assure-toi que c'est une valeur valide de ton enum ou string
                        'payment_date' => now(),
                        'transaction_id' => $session->payment_intent,
                    ]);

                    if ($payment) {
                        Log::info("Enregistrement Payment créé avec succès. ID: {$payment->id} pour résa {$reservation->id}.");
                        // Redirection finale après succès de la création du paiement
                         Log::info("Redirection vers DASHBOARD pour résa {$reservation->id}.");
                         return redirect()->route('dashboard')
                                ->with('success', 'Paiement réussi ! Votre réservation est confirmée.');
                    } else {
                        Log::error("Payment::create() a retourné null pour résa {$reservation->id}.");
                        // S'il y a un problème même sans l'erreur de colonne, on redirige ici
                        return redirect()->route('payments.index', ['reservation' => $reservation->id])->with('error', 'Erreur lors de la création de l\'enregistrement de paiement.');
                    }

                } catch (\Illuminate\Database\QueryException $dbException) {
                    Log::error("ERREUR DB lors de Payment::create() pour résa {$reservation->id}: " . $dbException->getMessage());
                    return redirect()->route('payments.index', ['reservation' => $reservation->id])->with('error', 'Erreur base de données lors de l\'enregistrement du paiement.');
                } catch (\Exception $e) {
                    Log::error("ERREUR GENERIQUE lors de Payment::create() pour résa {$reservation->id}: " . $e->getMessage());
                    return redirect()->route('payments.index', ['reservation' => $reservation->id])->with('error', 'Erreur inattendue lors de l\'enregistrement du paiement.');
                }

            } else {
                // SI LA CONDITION IF ÉCHOUE
                Log::warning("Condition IF succès NON REMPLIE pour résa {$reservation->id}. Status: '{$session->payment_status}', Metadata ID: '{$session->metadata->reservation_id}', Expected ID: '{$reservation->id}'");
                return redirect()->route('payments.index', ['reservation' => $reservation->id])->with('error', 'La confirmation du paiement a échoué (Statut ou ID incorrect).');
            }

        } catch (ApiErrorException $e) {
             Log::error("Erreur API Stripe lors de Session::retrieve() pour session {$stripeSessionId}: " . $e->getMessage());
            return redirect()->route('payments.index', ['reservation' => $reservationId])->with('error', 'Erreur de communication avec Stripe.');
        } catch (\Exception $e) {
             // L'erreur précédente venait ici car $reservation->save() échouait
             Log::error("Erreur interne générale dans success() pour résa {$reservationId}: " . $e->getMessage());
            return redirect()->route('payments.index', ['reservation' => $reservationId])->with('error', 'Une erreur inattendue est survenue lors de la confirmation.');
        }
    }
    
}