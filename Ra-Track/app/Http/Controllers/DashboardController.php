<?php

namespace App\Http\Controllers;

use App\Models\Plane; 
use App\Models\Airport;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        // Récupérer tous les avions de la base de données
        $planes = Plane::all(); // Récupère tous les avions
       
        $airports = Airport::all(); // Récupère tous les aéroports
        // Retourner la vue avec les données des avions
        return view('dashboardAdmin', compact('planes','airports')); // Passe la variable à la vue
    }
}



