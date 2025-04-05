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

    
    /**
     * Enregistrer un nouveau vol.
     */
    public function store(Request $request)
    {
        $request->validate([
            'flight_number' => 'required|string|unique:flights',
            'plane_id' => 'required|exists:planes,id',
            'departure_airport_id' => 'required|exists:airports,id',
            'arrival_airport_id' => 'required|exists:airports,id|different:departure_airport_id',
            'departure_time' => 'required|date|after:now',
            'arrival_time' => 'required|date|after:departure_time',
            'status' => 'required|string|in:scheduled,in_progress,cancelled,delayed,completed',
            'economy_class_price' => 'required|numeric|min:0',
            'business_class_price' => 'required|numeric|min:0',
            'first_class_price' => 'required|numeric|min:0',
        ]);

        $flight = Flight::create($request->all());

        return response()->json([
            'message' => 'Flight created successfully',
            'flight' => $flight
        ], 201);
    }

  
}
