<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Plane; 
use App\Models\Airport;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function showDashboard()

    {
        $users = User::all(); // Récupère tous les utilisateurs
        $flights = Flight::all(); // Récupère tous les vols
        $planes = Plane::all(); // Récupère tous les avions
        $airports = Airport::all(); // Récupère tous les aéroports
        $reservations = Reservation::with(['user', 'flight.departureAirport', 'flight.arrivalAirport'])->get();
        $payments = Payment::with([
            'reservation.user', // Charge l'utilisateur via la réservation
            'reservation.flight'  // Charge le vol via la réservation
        ])->get();
        $pilots = User::where('role', 'pilot')->get(); 


    // Statistiques supplémentaires
    $totalFlights = $flights->count();
    $totalPlanes = $planes->count();

    $statusDistribution = $flights->groupBy('status')->map->count();

    $monthlyFlights = Flight::select(
        DB::raw("TO_CHAR(departure_time, 'Mon') as month"),  // Utilisation de TO_CHAR() au lieu de DATE_FORMAT()
        DB::raw("COUNT(*) as count")
    )
    ->where('departure_time', '>=', now()->subMonths(6))
    ->groupBy(DB::raw("TO_CHAR(departure_time, 'Mon')"))
    ->orderByRaw("MIN(departure_time)")
    ->pluck('count', 'month');


    $mostActiveAirport = Flight::select('departure_airport_id', DB::raw('COUNT(*) as count'))
        ->groupBy('departure_airport_id')
        ->orderByDesc('count')
        ->first();

    $activeAirportName = $mostActiveAirport 
        ? Airport::find($mostActiveAirport->departure_airport_id)->name 
        : 'Aucun';

  // Obtenir l'année actuelle
$currentYear = now()->year;

// Nombre de réservations par mois
$reservationData = Reservation::select(
        DB::raw('EXTRACT(MONTH FROM created_at) as month'),
        DB::raw('COUNT(*) as count')
    )
    ->whereYear('created_at', $currentYear)
    ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
    ->orderBy('month')
    ->pluck('count', 'month');

 // Nombre de paiements par mois
$paymentData = Payment::select(
    DB::raw('EXTRACT(MONTH FROM created_at) as month'),
    DB::raw('COUNT(*) as count')
)
->whereYear('created_at', $currentYear)
->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
->orderBy('month')
->pluck('count', 'month');

   // Créer des labels pour chaque mois
    $monthLabels = [
    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
    ];
    
    // Compléter les données manquantes par 0 (si aucun paiement ou réservation pour certains mois)
    $reservationData = collect(range(1, 12))->map(function ($month) use ($reservationData) {
    return $reservationData[$month] ?? 0;
    });
    
    $paymentData = collect(range(1, 12))->map(function ($month) use ($paymentData) {
    return $paymentData[$month] ?? 0;
    });
    
     // 2. Données pour le graphique Cercle (Top 6 Vols les plus réservés)
    $topFlightsDataRaw = Reservation::select(
        'flights.flight_number',
        DB::raw('COUNT(reservations.id) as reservation_count')
    )
    ->join('flights', 'reservations.flight_id', '=', 'flights.id')
    ->groupBy('flights.flight_number')
    ->orderByDesc('reservation_count')
    ->limit(6)
    ->pluck('reservation_count', 'flights.flight_number'); // [' फ्लाइट_नंबर' => गिनती ]

// Séparer les labels et les données pour Chart.js
$topFlightsLabels = $topFlightsDataRaw->keys();
$topFlightsCounts = $topFlightsDataRaw->values();

// Retour de la vue avec toutes les données
return view('dashboardAdmin', compact(
    'planes', 'airports', 'flights', 'users', 'reservations', 'payments',
    'totalFlights', 'totalPlanes', 'statusDistribution', 'monthlyFlights', 'activeAirportName',
    'monthLabels',          // Labels pour le graphique en colonnes ( ['Jan', 'Feb', ...] )
    'paymentData',          // Données paiements pour graphique colonnes ( [1200, 1500, ...] )
    'reservationData',      // Données réservations pour graphique colonnes ( [15, 22, ...] )
    'topFlightsLabels',     // Labels pour le graphique cercle ( ['AF123', 'LH456', ...] )
    'topFlightsCounts' ,      // Données pour le graphique cercle ( [55, 48, ...] )
    'pilots'
)); 

    }
}



