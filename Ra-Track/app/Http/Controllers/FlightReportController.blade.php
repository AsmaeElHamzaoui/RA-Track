<?php

namespace App\Http\Controllers;

use App\Models\FlightReport;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FlightReportController extends Controller
{
    /**
     * Affiche la liste des rapports du pilote connecté.
     */
    public function index()
    {
        $reports = FlightReport::whereHas('flight', function ($query) {
            $query->where('pilot_id', Auth::id());
        })->with('flight')->get();

        return view('flight_reports.index', compact('reports'));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        $flightsREs = Flight::where('pilot_id', Auth::id())->get();
        return view('flight_reports.create', compact('flightsREs'));
    }

 

}
