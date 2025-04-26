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
use App\Models\Passenger; // Pour la méthode success
use Illuminate\Database\QueryException; // Pour attraper les erreurs DB spécifiques
use Barryvdh\DomPDF\Facade\Pdf;


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

    public function success(Request $request, $reservationId)
    {
        // 1. Récupérer la réservation
        $reservation = Reservation::find($reservationId);
        if (!$reservation) {
            Log::error("Réservation ID {$reservationId} non trouvée lors du retour de succès Stripe.");
            return redirect()->route('home')->with('error', 'Réservation non trouvée.');
        }

        // 2. Récupérer l'ID de session Stripe
        $stripeSessionId = $request->query('session_id');
        if (!$stripeSessionId) {
            Log::warning("ID de session Stripe manquant pour réservation ID {$reservationId}.");
            // Redirige vers la page de paiement de cette réservation si possible
            return redirect()->route('payments.index', ['reservation' => $reservation->id])
                   ->with('error', 'Information de paiement manquante pour confirmer la transaction.');
        }

        // 3. Traitement principal dans un bloc try pour gérer les erreurs
        try {
            // Configurer Stripe
            Stripe::setApiKey(config('services.stripe.secret'));
            // Récupérer la session Stripe
            $session = Session::retrieve($stripeSessionId);
            Log::debug('Stripe Session Retrieved:', ['session_id' => $stripeSessionId, 'status' => $session->payment_status, 'metadata' => $session->metadata]);

            // 4. Vérification CRUCIALE : Statut 'paid' et correspondance des métadonnées
            if ($session->metadata->reservation_id == $reservation->id && $session->payment_status == 'paid') {

                Log::info("Condition IF succès REMPLIE pour résa {$reservation->id}.");

                // 5. Charger les relations nécessaires de manière efficace
                $reservation->loadMissing(['passengers', 'flight.plane']);

                // 6. Vérifier si le paiement a déjà été enregistré pour éviter les doublons
                $existingPayment = Payment::where('transaction_id', $session->payment_intent)->first();

                if ($existingPayment) {
                    Log::info("Paiement déjà existant trouvé pour résa {$reservation->id} (Transac ID: {$session->payment_intent}). Redirection vers confirmation.");
                    // Si le paiement est déjà enregistré, rediriger directement vers la confirmation
                    return redirect()->route('reservation.confirmation', ['reservation' => $reservation->id])
                           ->with('info', 'Cette réservation a déjà été confirmée.'); // Message informatif
                }

                // --- 7. Assignation des Sièges (si nécessaire) ---
                // Placé avant la création du Payment : si l'assignation échoue, on ne crée pas l'enregistrement Payment.
                try {
                    $this->assignSeats($reservation); // Appel de la méthode d'assignation (voir ci-dessous)
                } catch (\Exception $e) {
                    // Si l'assignation échoue (ex: plus de sièges), on log et redirige avec erreur
                    Log::error("ERREUR critique lors de l'assignation des sièges pour résa {$reservation->id}: " . $e->getMessage());
                    return redirect()->route('payments.index', ['reservation' => $reservation->id]) // Retour à la page précédente
                           ->with('error', 'Paiement réussi, mais une erreur est survenue lors de l\'assignation des sièges. Veuillez contacter le support. Détail : ' . $e->getMessage());
                }
                // --- Fin Assignation de Siège ---


                // --- 8. Créer l'enregistrement de Paiement ---
                try {
                    Log::info("Tentative de création de l'enregistrement Payment pour réservation {$reservation->id}.");
                    $payment = Payment::create([
                        'reservation_id' => $reservation->id,
                        'payment_method' => 'credit_card', // Ou la méthode appropriée ('stripe_card' si tu as changé l'enum/string)
                        'payment_date' => now(),
                        'transaction_id' => $session->payment_intent, // Utilise l'ID de l'intention de paiement comme ID unique
                    ]);

                    if ($payment) {
                        Log::info("Enregistrement Payment créé avec succès. ID: {$payment->id} pour résa {$reservation->id}.");
                    } else {
                        // Ceci ne devrait pas arriver si 'create' ne lève pas d'exception, mais par sécurité
                        Log::error("Payment::create() a retourné null (sans exception) pour résa {$reservation->id}.");
                        throw new \Exception("La création de l'enregistrement de paiement a échoué silencieusement.");
                    }

                } catch (QueryException $dbException) {
                    // Erreur spécifique de la base de données (contrainte unique, etc.)
                    Log::error("ERREUR BASE DE DONNÉES lors de Payment::create() pour résa {$reservation->id}: " . $dbException->getMessage());
                    // Le paiement Stripe est passé, mais l'enregistrement échoue : situation critique
                    return redirect()->route('dashboard') // Rediriger vers un endroit sûr
                           ->with('error', 'Votre paiement a été accepté, mais une erreur technique est survenue lors de son enregistrement. Veuillez contacter le support avec la référence : ' . $reservation->booking_reference);
                } catch (\Exception $e) {
                    // Autre erreur lors de la création
                    Log::error("ERREUR GENERIQUE lors de Payment::create() pour résa {$reservation->id}: " . $e->getMessage());
                     return redirect()->route('dashboard')
                           ->with('error', 'Votre paiement a été accepté, mais une erreur inattendue est survenue lors de son enregistrement. Contactez le support. Réf: ' . $reservation->booking_reference);
                }
                // --- Fin Création Paiement ---


                // --- 9. Redirection Finale vers la Page de Confirmation ---
                // Si on arrive ici, tout s'est bien passé (Stripe OK, Sièges OK, Paiement enregistré OK)
                Log::info("Redirection vers la page de confirmation pour résa {$reservation->id}.");
                return redirect()->route('reservation.confirmation', ['reservation' => $reservation->id])
                       ->with('success', 'Paiement réussi ! Votre réservation est confirmée. Vous pouvez maintenant télécharger vos billets.');


            } else {
                // Si la vérification Stripe échoue (statut != 'paid' ou metadata incorrecte)
                Log::warning("Condition IF succès NON REMPLIE pour résa {$reservation->id}. Status: '{$session->payment_status}', Metadata ID: '{$session->metadata->reservation_id}', Expected ID: '{$reservation->id}'");
                return redirect()->route('payments.index', ['reservation' => $reservation->id])
                       ->with('error', 'La confirmation du paiement a échoué. Le statut du paiement n\'est pas correct ou les informations ne correspondent pas.');
            }

        } catch (ApiErrorException $e) {
            // Erreur lors de la communication avec l'API Stripe
            Log::error("Erreur API Stripe lors de Session::retrieve() pour session {$stripeSessionId}: " . $e->getMessage());
            return redirect()->route('payments.index', ['reservation' => $reservationId])
                   ->with('error', 'Erreur de communication avec le service de paiement Stripe.');
        } catch (\Exception $e) {
            // Autres erreurs inattendues (ex: config, réseau, erreur dans le code avant les catch spécifiques)
            Log::error("Erreur interne générale dans success() pour résa {$reservationId}: " . $e->getMessage());
             return redirect()->route('payments.index', ['reservation' => $reservationId])
                    ->with('error', 'Une erreur inattendue est survenue lors de la confirmation de votre paiement.');
        }
    }

    /**
     * Assigne des numéros de siège aux passagers d'une réservation qui n'en ont pas encore.
     *
     * @param Reservation $reservation L'objet Reservation (avec flight.plane et passengers pré-chargés)
     * @throws \Exception Si la capacité n'est pas définie, ou si aucun siège ne peut être trouvé.
     */
    protected function assignSeats(Reservation $reservation)
    {
        if (!$reservation->flight || !$reservation->flight->plane) {
            throw new \Exception("Données vol/avion manquantes pour assignation sièges (Résa ID: {$reservation->id}).");
        }

        $plane = $reservation->flight->plane;
        $flight_id = $reservation->flight_id;
        $reservation_class = strtolower($reservation->class);

        // Déterminer la capacité pour la classe
        $capacity = match ($reservation_class) {
            'economy' => $plane->economy_class_capacity,
            'business' => $plane->business_class_capacity,
            'first' => $plane->first_class_capacity,
            default => 0,
        };

        if ($capacity <= 0) {
            throw new \Exception("Capacité avion non définie/nulle pour classe '{$reservation_class}' (Résa ID: {$reservation->id}).");
        }

        // Récupérer les sièges déjà assignés pour ce vol et cette classe
        // Important : On filtre par flight_id ET classe pour éviter les conflits entre classes sur le même vol
        $assignedSeats = Passenger::whereHas('reservation', function ($query) use ($flight_id, $reservation_class) {
                                $query->where('flight_id', $flight_id)
                                      ->where('class', $reservation_class); // Assure qu'on ne compare que les sièges de la même classe
                            })
                            ->whereNotNull('seat_number')
                            ->pluck('seat_number') // ['1A', '1B', '2C']
                            ->toArray();

        Log::debug("Assignation Sièges - Résa {$reservation->id}, Vol {$flight_id}, Classe {$reservation_class}. Capacité: {$capacity}. Sièges déjà pris: " . implode(', ', $assignedSeats));

        // Sélectionne uniquement les passagers de CETTE réservation qui n'ont PAS de siège
        $passengersToAssignSeats = $reservation->passengers->whereNull('seat_number');

        if ($passengersToAssignSeats->isEmpty()) {
            Log::info("Aucun siège à assigner pour la résa {$reservation->id}, tous les passagers ont déjà un siège.");
            return; // Rien à faire
        }

        // --- Algorithme Simplifié de Génération de Sièges ---
        // TODO: Remplacer par une logique basée sur la config réelle de l'avion si possible
        $maxRows = ceil($capacity / 6); // Estimation basée sur 6 sièges/rangée (A-F)
        $seatLetters = ['A', 'B', 'C', 'D', 'E', 'F'];
        $availableSeatFoundCount = 0;
        // --- Fin Algorithme Simplifié ---

        foreach ($passengersToAssignSeats as $passenger) {
            $seatAssigned = false;
            // Chercher un siège disponible (logique simplifiée)
            for ($row = 1; $row <= $maxRows; $row++) {
                foreach ($seatLetters as $letter) {
                    $currentSeat = $row . $letter;
                    // Vérifier si on dépasse la capacité théorique (sécurité)
                    if (($row - 1) * 6 + array_search($letter, $seatLetters) + 1 > $capacity) {
                         continue; // Ne pas considérer les sièges au-delà de la capacité
                    }

                    // Vérifier si le siège est déjà dans la liste des sièges pris
                    if (!in_array($currentSeat, $assignedSeats)) {
                        // Siège trouvé ! On l'assigne et on sauvegarde.
                        $passenger->seat_number = $currentSeat;
                        if ($passenger->save()) {
                            $assignedSeats[] = $currentSeat; // Marquer comme pris pour cette requête
                            $seatAssigned = true;
                            $availableSeatFoundCount++;
                            Log::info("Siège {$currentSeat} assigné et sauvegardé pour passager {$passenger->id} (Résa {$reservation->id}).");
                            break 2; // Sortir des deux boucles (letters et rows) pour passer au passager suivant
                        } else {
                            Log::error("ÉCHEC SAUVEGARDE siège {$currentSeat} pour passager {$passenger->id}. Tentative continue...");
                             // Que faire ici? Si la sauvegarde échoue, le siège n'est pas vraiment pris.
                             // On pourrait essayer le siège suivant, ou lever une exception.
                             // Pour l'instant, on continue d'essayer d'autres sièges.
                        }
                    }
                }
            }

            // Si après avoir parcouru tous les sièges possibles, on n'a rien trouvé pour ce passager
            if (!$seatAssigned) {
                 Log::critical("Aucun siège disponible trouvé pour passager {$passenger->id} (Résa {$reservation->id}, Vol {$flight_id}, Classe {$reservation_class}). Capacité: {$capacity}, Nombre déjà assigné: " . count($assignedSeats));
                 throw new \Exception("Impossible d'assigner un siège au passager {$passenger->firstname} {$passenger->lastname}. Plus de places disponibles ou erreur lors de l'assignation.");
            }
        }
         Log::info("Assignation de sièges terminée pour résa {$reservation->id}. {$availableSeatFoundCount} sièges assignés.");
    }
     /**
     * Gère la redirection après une annulation de paiement.
     */
    public function cancel(Request $request) // Ajout de Request pour potentiellement récupérer l'ID si passé en query param
    {
        $reservationId = $request->query('reservation_id');
        $redirectRoute = $reservationId ? route('payments.index', $reservationId) : route('dashboard'); // Retourne à la page de paiement si possible

        return redirect($redirectRoute)
               ->with('info', 'Le processus de paiement a été annulé. Votre réservation n\'est pas confirmée.');
    }


    public function destroy(Payment $payment)
    {
        try {
            $paymentId = $payment->id; // Sauvegarde l'ID pour le log
            $payment->delete(); // Supprime l'enregistrement de la base de données

            Log::info("Paiement ID {$paymentId} supprimé avec succès par l'utilisateur ID " . (Auth::id() ?? 'Système'));

            // Retourne une réponse JSON de succès
            return response()->json([
                'success' => true, // Tu peux utiliser 'success' ou juste 'message'
                'message' => 'Paiement supprimé avec succès.'
            ]); // HTTP 200 OK par défaut

        } catch (\Exception $e) {
            // Log l'erreur pour le débogage
            Log::error("Erreur lors de la suppression du paiement ID {$payment->id}: " . $e->getMessage());

            // Retourne une réponse JSON d'erreur
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression du paiement.'
            ], 500); // HTTP 500 Internal Server Error
        }
    }
}