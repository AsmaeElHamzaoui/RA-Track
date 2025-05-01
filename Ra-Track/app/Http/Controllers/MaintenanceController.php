<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Plane;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    // Afficher toutes les maintenances
    public function index()
    {
        $maintenances = Maintenance::with('aircraft')->latest()->get();
        return view('maintenances.index', compact('maintenances'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        $planes = Plane::all();
        return view('maintenances.create', compact('planes'));
    }

    // Enregistrer une nouvelle maintenance
    public function store(Request $request)
    {
        $request->validate([
            'aircraft_id' => 'required|exists:planes,id',
            'maintenance_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        Maintenance::create($request->all());

        return redirect()->route('maintenances.index')->with('success', 'Maintenance planifiée avec succès.');
    }

    
}
