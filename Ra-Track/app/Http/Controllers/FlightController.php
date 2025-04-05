<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    /**
     * Afficher la liste de tous les vols.
     */
    public function index()
    {
        $flights = Flight::with(['plane', 'departureAirport', 'arrivalAirport'])->get();
        return response()->json($flights);
    }

}
