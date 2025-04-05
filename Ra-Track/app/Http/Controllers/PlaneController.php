<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    /**
     * Afficher la liste de tous les avions.
     */
    public function index()
    {
        $planes = Plane::with('flights', 'flightTrackings')->get();
        return response()->json($planes);
    }

      /**
     * Enregistrer un nouvel avion.
     */
    public function store(Request $request)
    {
        $request->validate([
            'registration' => 'required|string|unique:planes',
            'model' => 'required|string',
            'manufacturer' => 'required|string',
            'airline_company' => 'required|string',
            'economy_class_capacity' => 'required|integer|min:0',
            'business_class_capacity' => 'required|integer|min:0',
            'first_class_capacity' => 'required|integer|min:0',
            'maximum_load' => 'required|numeric|min:0',
            'flight_range' => 'required|numeric|min:0',
            'status' => 'required|string|in:active,inactive,maintenance',
        ]);

        $plane = Plane::create($request->all());

        return response()->json([
            'message' => 'Plane created successfully',
            'plane' => $plane
        ], 201);
    }

    /**
     * Afficher les détails d'un avion spécifique.
     */
    public function show($id)
    {
        $plane = Plane::with('flights', 'flightTrackings')->findOrFail($id);
        return response()->json($plane);
    }

  
}
