<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Plane; 
use App\Models\Airport;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()

    {
        $users = User::all(); // Récupère tous les utilisateurs
        $flights = Flight::all(); // Récupère tous les vols
        $planes = Plane::all(); // Récupère tous les avions
        $airports = Airport::all(); // Récupère tous les aéroports
        // Retourner la vue avec les données des avions
        return view('dashboardAdmin', compact('planes','airports','flights','users')); // Passe la variable à la vue
    }
}



