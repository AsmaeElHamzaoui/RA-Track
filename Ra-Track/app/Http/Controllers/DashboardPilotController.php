<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardPilotController extends Controller
{
    public function showDashboard()

    {
       
     
        $pilotId = Auth::id(); // ou Auth::user()->id

       // récupèration des vols assignés au pilote connecté
       $flightsREs = Flight::where('pilot_id', $pilotId)
       ->get(['id', 'flight_number']);

       
       return view('dashboardPilot', compact('flightsREs')); 

    }
}



