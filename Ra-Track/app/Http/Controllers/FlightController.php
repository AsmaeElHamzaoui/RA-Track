<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


class FlightController extends Controller
{
    /**
     * Afficher la liste de tous les vols.
     */
    public function index()
    {
        $flights = Flight::with(['plane', 'departureAirport', 'arrivalAirport'])->orderBy('id', 'asc')->get();
        return response()->json($flights);
    }

    
    /**
     * Enregistrer un nouveau vol.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
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
    
    
        
            $flight = Flight::create($validated);
            return response()->json($flight, Response::HTTP_CREATED);
       
    }
    

      /**
     * Afficher les détails d'un vol spécifique.
     */
    public function show($id)
    {
        $flight = Flight::with(['plane', 'departureAirport', 'arrivalAirport'])->findOrFail($id);
        return view('detailsFlight', ['flight' => $flight]);
    }
  
    
    /**
     * Mettre à jour les informations d'un vol.
     */
    public function update(Request $request, $id)
    {
        $flight = Flight::findOrFail($id);

        $request->validate([
            'flight_number' => 'required|string|unique:flights,flight_number,' . $id,
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
        

        $flight->update($request->all());

        return response()->json([
            'message' => 'Flight updated successfully',
            'flight' => $flight
        ]);
    }

    /**
     * Supprimer un vol.
     */
    public function destroy($id)
    {
        $flight = Flight::findOrFail($id);
        $flight->delete();

        return response()->json([
            'message' => 'Flight deleted successfully'
        ]);
    }
}
