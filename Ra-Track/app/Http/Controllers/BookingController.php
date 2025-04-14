<?php

namespace App\Http\Controllers;

use App\Models\Flight;
// Retire Plane si tu ne l'utilises pas directement pour le filtrage initial
// use App\Models\Plane; 
use App\Models\Airport;
use Illuminate\Http\Request; // Important: Importer Request
use Carbon\Carbon; // Importer Carbon pour la manipulation des dates si nécessaire

class BookingController extends Controller
{
    public function showBooking(Request $request) // Injecter Request
    {
        // Récupérer les paramètres de la requête GET
        $departureAirportId = $request->input('departure');
        $arrivalAirportId = $request->input('arrival');
        $departureDate = $request->input('date');

        // Commencer une requête Eloquent sur le modèle Flight
        $query = Flight::query();

        // Appliquer les filtres si les paramètres sont présents
        if ($departureAirportId) {
            // Assure-toi que le nom de la colonne est correct (ex: departure_airport_id)
            $query->where('departure_airport_id', $departureAirportId); 
        }

        if ($arrivalAirportId) {
            // Assure-toi que le nom de la colonne est correct (ex: arrival_airport_id)
            $query->where('arrival_airport_id', $arrivalAirportId);
        }

        if ($departureDate) {
            // Filtrer par la *date* de départ. 
            // Assure-toi que 'departure_time' est le nom correct de ta colonne DATETIME/TIMESTAMP/DATE
            // whereDate compare uniquement la partie date
            $query->whereDate('departure_time', $departureDate); 
        }

        // Exécuter la requête pour obtenir les vols filtrés
        // Eager load les relations pour éviter le problème N+1 query
        // Adapte les noms des relations ('departureAirport', 'arrivalAirport') à ceux définis dans ton modèle Flight
        $flights = $query->with(['departureAirport', 'arrivalAirport'/*, 'airline' si tu as cette relation */])->get(); 

        // Récupérer tous les aéroports pour les dropdowns (comme avant)
        $airports = Airport::all(); 
        
        // Récupérer les avions n'est probablement pas nécessaire ici, sauf si tu les affiches
        // $planes = Plane::all(); 

        // Retourner la vue avec les aéroports et les vols (filtrés ou tous)
        // Retire 'planes' si non utilisé
        return view('bookingAirplane', compact('airports', 'flights')); 
    }
}