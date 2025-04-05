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

      /**
     * Afficher les détails d'un vol spécifique.
     */
    public function show($id)
    {
        $flight = Flight::with(['plane', 'departureAirport', 'arrivalAirport'])->findOrFail($id);
        return response()->json($flight);
    }
  
    
    /**
     * Mettre à jour les informations d'un vol.
     */
    public function update(Request $request, $id)
    {
        $flight = Flight::findOrFail($id);

        $request->validate([
            'flight_number' => 'sometimes|string|unique:flights,flight_number,' . $id,
            'plane_id' => 'sometimes|exists:planes,id',
            'departure_airport_id' => 'sometimes|exists:airports,id',
            'arrival_airport_id' => 'sometimes|exists:airports,id|different:departure_airport_id',
            'departure_time' => 'sometimes|date|after:now',
            'arrival_time' => 'sometimes|date|after:departure_time',
            'status' => 'sometimes|string|in:scheduled,in_progress,cancelled,delayed,completed',
            'economy_class_price' => 'sometimes|numeric|min:0',
            'business_class_price' => 'sometimes|numeric|min:0',
            'first_class_price' => 'sometimes|numeric|min:0',
        ]);

        $flight->update($request->all());

        return response()->json([
            'message' => 'Flight updated successfully',
            'flight' => $flight
        ]);
    }

    
}
