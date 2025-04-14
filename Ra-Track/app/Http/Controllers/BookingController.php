<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Plane; 
use App\Models\Airport;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function showBooking()
    {
        $flights = Flight::all(); // Récupère tous les vols
        $planes = Plane::all(); // Récupère tous les avions
        $airports = Airport::all(); // Récupère tous les aéroports
        // Retourner la vue avec les données des avions
        return view('bookingAirplane', compact('planes','airports','flights')); // Passe la variable à la vue
    }
}



