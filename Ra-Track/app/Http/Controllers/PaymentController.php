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

    
}