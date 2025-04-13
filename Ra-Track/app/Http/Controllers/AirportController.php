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
    public function update(Request $request, $id )
    {
        $airport = Airport::findOrFail($id);
        $validated = $request->validate([
            'code_iata' => 'required|string|max:10|unique:airports,code_iata,' . $airport->id,
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $airport->update($validated);
        return response()->json([
            'message' => 'airport mis à jour avec succès.',
            'airport' => $airport
        ]);
    }

    /**
     * Supprimer un aéroport.
     */
    public function destroy($id)
    {

        $airport= Airport::findOrFail($id);
        $airport->delete();

        return response()->json([
            'message' => 'Airport supprimé avec succès.'
        ]);
    }
}
