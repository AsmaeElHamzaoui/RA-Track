<?php

namespace App\Http\Controllers;

use App\Models\Plane; // Ajoute cette ligne pour importer le modèle Plane
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        // Récupérer tous les avions de la base de données
        $planes = Plane::all(); // Récupère tous les avions
    
        // Retourner la vue avec les données des avions
        return view('dashboardAdmin', compact('planes')); // Passe la variable à la vue
    }
}



