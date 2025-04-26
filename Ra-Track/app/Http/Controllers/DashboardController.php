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

    // Retour de la vue avec toutes les données
    // return view('dashboardAdmin', compact(
    //     'planes', 'airports', 'flights', 'users',
    //     'totalFlights', 'totalPlanes', 'statusDistribution',
    //     'monthlyFlights', 'activeAirportName', 'reservations','payments'
    // ));    
    }
}



