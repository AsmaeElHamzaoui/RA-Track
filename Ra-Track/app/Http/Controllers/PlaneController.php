<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    /**
     * Affiche la liste des avions.
     */
    public function index()
    {
        $planes = Plane::all();
        return response()->json($planes);
    }

    /**
     * Affiche les détails d’un seul avion.
     */
    public function show($id)
    {
        $plane = Plane::findOrFail($id);
        return response()->json($plane);
    }
    public function getByRegistration($registration){
        $plane = Plane::findOrFail($registration);
        return response()->json($plane);
    }

    /**
     * Enregistre un nouvel avion.
     */
    public function store(Request $request)
{
    // Validation des autres champs
    $validated = $request->validate([
        'registration' => 'required|string',
        'model' => 'required|string',
        'manufacturer' => 'required|string',
        'airline_company' => 'required|string',
        'economy_class_capacity' => 'required|integer|min:0',
        'business_class_capacity' => 'required|integer|min:0',
        'first_class_capacity' => 'required|integer|min:0',
        'maximum_load' => 'required|numeric|min:0',
        'flight_range' => 'required|integer|min:0',
        'status' => 'required|in:active,under maintenance,out of service',
    ]);

    // Vérification si un avion avec la même immatriculation existe déjà
    $existingPlane = Plane::where('registration', $request->registration)->first();

    if ($existingPlane) {
        // Si l'immatriculation existe déjà, renvoyer un message d'erreur
        return response()->json([
            'message' => 'Un avion existe déjà avec cette immatriculation.',
        ], 400); // 400 Bad Request
    }

    // Création du nouvel avion si l'immatriculation est unique
    $plane = Plane::create($validated);

    return response()->json([
        'message' => 'Avion ajouté avec succès.',
        'plane' => $plane
    ], 201);
}


    /**
     * Met à jour un avion existant.
     */
    public function update(Request $request, $id)
    {
        $plane = Plane::findOrFail($id);

        $validated = $request->validate([
            'registration' => 'required|string|unique:planes,registration,' . $plane->id,
            'model' => 'required|string',
            'manufacturer' => 'required|string',
            'airline_company' => 'required|string',
            'economy_class_capacity' => 'required|integer|min:0',
            'business_class_capacity' => 'required|integer|min:0',
            'first_class_capacity' => 'required|integer|min:0',
            'maximum_load' => 'required|numeric|min:0',
            'flight_range' => 'required|integer|min:0',
            'status' => 'required|in:active,under maintenance,out of service',
        ]);

        $plane->update($validated);

        return response()->json([
            'message' => 'Avion mis à jour avec succès.',
            'plane' => $plane
        ]);
    }

    /**
     * Supprime un avion.
     */
    public function destroy($id)
    {
        $plane = Plane::findOrFail($id);
        $plane->delete();

        return response()->json([
            'message' => 'Avion supprimé avec succès.'
        ]);
    }
}
