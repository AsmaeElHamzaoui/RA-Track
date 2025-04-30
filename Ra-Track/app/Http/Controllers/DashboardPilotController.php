<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\FlightReport;


class DashboardPilotController extends Controller
{
    public function showDashboard()

    {
        $pilotId = Auth::id(); // ou Auth::user()->id

        // Récupération des vols assignés au pilote avec toutes les informations nécessaires
        $flights = Flight::with(['departureAirport', 'arrivalAirport'])
        ->where('pilot_id', $pilotId)
        ->where('departure_time', '>=', now()->format('Y-m-d H:i:s')) // Format compatible avec votre DB
        ->orderBy('departure_time')
        ->get()
        ->map(function ($flight) {
            // Convertir les strings en objets Carbon
            $flight->departure_time = \Carbon\Carbon::parse($flight->departure_time);
            $flight->arrival_time = \Carbon\Carbon::parse($flight->arrival_time);
            return $flight;
        });

        // Récupérer les rapports dont le vol appartient au pilote connecté
        $reports = FlightReport::whereHas('flight', function ($query) use ($pilotId) {
            $query->where('pilot_id', $pilotId);
        })->with('flight')->latest()->get();

        return view('dashboardPilot', compact('flights', 'reports'));
    }
}
