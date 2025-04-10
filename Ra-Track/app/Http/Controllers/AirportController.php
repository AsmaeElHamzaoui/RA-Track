<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AirportController extends Controller
{
    /**
     * Afficher la liste des aéroports.
     */
    public function index()
    {
        $airports = Airport::orderBy('id', 'asc')->get();

        return response()->json($airports);
    }

    
      /**
     * Stocker un nouvel aéroport.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_iata' => 'required|string|max:10|unique:airports',
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $airport = Airport::create($validated);
        return response()->json($airport, Response::HTTP_CREATED);
    }

    /**
     * Afficher un aéroport spécifique.
     */
    public function show(Airport $airport)
    {
        return response()->json($airport, Response::HTTP_OK);
    }

    
    /**
     * Mettre à jour un aéroport existant.
     */
    public function update(Request $request, Airport $airport)
    {
        $validated = $request->validate([
            'code_iata' => 'sometimes|string|max:10|unique:airports,code_iata,' . $airport->id,
            'name' => 'sometimes|string|max:255',
            'location' => 'sometimes|string|max:255',
        ]);

        $airport->update($validated);
        return response()->json($airport, Response::HTTP_OK);
    }

    /**
     * Supprimer un aéroport.
     */
    public function destroy(Airport $airport)
    {
        $airport->delete();
        return response()->json(['message' => 'Aéroport supprimé avec succès'], Response::HTTP_NO_CONTENT);
    }
}
