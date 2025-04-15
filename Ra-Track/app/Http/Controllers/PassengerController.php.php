<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    /**
     * Affiche la liste de tous les passagers.
     */
    public function index()
    {
        $passengers = Passenger::all();

        return response()->json([
            'status' => 'success',
            'data' => $passengers
        ]);
    }

    /**
     * Enregistre un nouveau passager.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'age' => 'nullable|integer|min:0',
            'sexe' => 'nullable|in:Homme,Femme',
        ]);

        $passenger = Passenger::create([
            'reservation_id' => $validated['reservation_id'],
            'lastname' => $validated['nom'],
            'firstname' => $validated['prenom'],
            'age' => $validated['age'],
            'gender' => $validated['sexe'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Passager créé avec succès.',
            'data' => $passenger
        ], 201);
    }


       /**
     * Affiche un passager spécifique.
     */
    public function show(Passenger $passenger)
    {
        return response()->json([
            'status' => 'success',
            'data' => $passenger
        ]);
    }

   
}
