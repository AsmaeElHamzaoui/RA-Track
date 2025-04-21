<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use App\Models\Reservation; // Peut-être pas nécessaire si on passe par Passenger
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate; // Pour l'autorisation
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
// Ou use PDF;

class TicketController extends Controller
{
    /**
     * Génère et télécharge le PDF du billet pour un passager spécifique.
     *
     * @param  \App\Models\Passenger  $passenger
     * @return \Symfony\Component\HttpFoundation\Response|\Illuminate\Http\RedirectResponse
     */
    public function downloadTicket(Passenger $passenger)
    {
        // --- AUTORISATION ---
        // Charger la réservation associée au passager
        $reservation = $passenger->reservation()->with('user')->first(); // Charger l'utilisateur lié à la résa

        if (!$reservation) {
            Log::warning("Tentative de téléchargement de billet pour passager {$passenger->id} sans réservation associée.");
            abort(404, 'Réservation non trouvée.');
        }

        // Vérifier si l'utilisateur connecté est celui qui a fait la réservation
        if (!Auth::check() || Auth::id() !== $reservation->user_id) {
             // Optionnel: Autoriser les admins
             // if (!Auth::user()?->isAdmin()) {
                  Log::warning("Accès non autorisé au téléchargement du billet. User ID: " . Auth::id() . ", Passager ID: {$passenger->id}, Réservation User ID: {$reservation->user_id}");
                  abort(403, 'Accès non autorisé à ce billet.');
             // }
        }

        // Vérifier si le siège est assigné
        if (empty($passenger->seat_number)) {
            Log::error("Tentative de téléchargement de billet pour passager {$passenger->id} sans siège assigné.");
            // Rediriger vers la confirmation avec une erreur ?
            return redirect()->route('reservation.confirmation', ['reservation' => $reservation->id])
                   ->with('error', "Le siège pour {$passenger->firstname} {$passenger->lastname} n'a pas encore été assigné.");
        }


        // --- Génération PDF ---
        try {
            // Charger toutes les données nécessaires pour la vue PDF
            $passenger->loadMissing(['reservation.flight.departureAirport', 'reservation.flight.arrivalAirport']);

            Log::info("Génération du PDF pour billet passager {$passenger->id} (Résa {$reservation->id})");

            $pdf = Pdf::loadView('pdf.ticket', compact('passenger'));
            // Ou si tu as des options spécifiques pour dompdf :
            // $pdf = Pdf::loadView('pdf.ticket', compact('passenger'))->setPaper('a4', 'portrait');

            // Nom du fichier
            $safeName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $passenger->lastname . '_' . $passenger->firstname);
            $filename = "billet_{$safeName}_{$passenger->reservation->booking_reference}.pdf";

            return $pdf->download($filename);

        } catch (\Exception $e) {
            Log::error("ERREUR lors de la génération du PDF du billet pour passager {$passenger->id}: " . $e->getMessage());
            // Rediriger vers la confirmation avec une erreur
            return redirect()->route('reservation.confirmation', ['reservation' => $reservation->id])
                   ->with('error', 'Une erreur est survenue lors de la génération de votre billet PDF. Veuillez réessayer ou contacter le support.');
        }
    }
}