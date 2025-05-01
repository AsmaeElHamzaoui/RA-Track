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

    
}
