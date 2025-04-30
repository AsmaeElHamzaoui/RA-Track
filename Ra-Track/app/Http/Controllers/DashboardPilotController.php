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
        // récupèration des vols assignés au pilote connecté
        $flights = Flight::where('pilot_id', $pilotId)
            ->get(['id', 'flight_number']);

        // Récupérer les rapports dont le vol appartient au pilote connecté
        $reports = FlightReport::whereHas('flight', function ($query) use ($pilotId) {
            $query->where('pilot_id', $pilotId);
        })->with('flight')->latest()->get();

        return view('dashboardPilot', compact('flights', 'reports'));
    }
}
