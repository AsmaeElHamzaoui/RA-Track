<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Plane;
use Illuminate\Http\Request;
use Illuminate\Http\Response; // <-- Ajouté pour les codes de statut HTTP
use Illuminate\Support\Facades\Redirect; // Gardé si jamais utilisé ailleurs
use Illuminate\Support\Facades\Route; // Nécessaire pour générer l'URL de redirection

class MaintenanceController extends Controller
{

    
    public function index()
    {
        $maintenances = Maintenance::with('aircraft')->latest()->get();
        return view('maintenances.index', compact('maintenances'));
    }

    
    public function create()
    {
        $planes = Plane::all();
        return view('maintenances.create', compact('planes'));
    }

    
    public function store(Request $request)
    {
        // La validation reste la même
        $validated = $request->validate([
            'aircraft_id' => 'required|exists:planes,id',
            'maintenance_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date', // Changé pour required comme dans le JS modal
        ]);

        $maintenance = Maintenance::create($validated);
        $maintenance->load('aircraft');

        // Renvoyer une réponse JSON pour AJAX
        return response()->json([
            'message' => 'Maintenance planifiée avec succès!',
            'redirect_url' => route('dashboardAgent'), // <-- L'URL clé pour le JS
            'maintenance' => $maintenance // Optionnel: l'objet créé
        ], Response::HTTP_CREATED); // Code 201: Créé avec succès
    }

    public function show(Maintenance $maintenance)
    {
        $maintenance->loadMissing('aircraft');
        return view('maintenances.show', compact('maintenance'));
    }

    
    public function edit(Maintenance $maintenance)
    {
        $planes = Plane::all();
        // Si cette vue n'est plus utilisée, vous pouvez supprimer cette méthode ou la commenter.
        return view('maintenances.edit', compact('maintenance', 'planes'));
    }

    
    public function update(Request $request, Maintenance $maintenance)
    {
        // La validation reste la même
        $validated = $request->validate([
            'aircraft_id' => 'required|exists:planes,id',
            'maintenance_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date', // Changé pour required comme dans le JS modal
        ]);

        // Mettre à jour la maintenance avec les données validées
        $maintenance->update($validated);
        $maintenance->load('aircraft');

        // Renvoyer une réponse JSON pour AJAX
        return response()->json([
            'message' => 'Maintenance mise à jour avec succès!',
            'redirect_url' => route('dashboardAgent'), // <-- L'URL clé pour le JS
            'maintenance' => $maintenance // Optionnel: l'objet mis à jour
        ]); // Code 200 OK (par défaut)
    }

    
    public function destroy(Maintenance $maintenance)
    {
       
        $maintenance->delete();
        // Renvoyer une réponse JSON pour AJAX
        return response()->json([
            'message' => 'Maintenance supprimée.',
            'redirect_url' => route('dashboardAgent') // <-- L'URL clé pour le JS
        ]); // Code 200 OK (par défaut)
    }
}