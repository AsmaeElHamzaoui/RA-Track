<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    /**
     * Liste tous les passagers
     */
    public function index()
    {
        return response()->json(Passenger::all(), 200);
    }

    /**
     * Crée un ou plusieurs passagers
     */
    public function store(Request $request)
    {
        // Récupérer les données
        $data = $request->all();

        // Vérifier si c'est une seule entrée (objet JSON) ou un tableau de plusieurs
        $isMultiple = isset($data[0]) && is_array($data[0]);

        $passengers = [];

        if ($isMultiple) {
            foreach ($data as $item) {
                $validated = validator($item, [
                    'reservation_id' => 'required|exists:reservations,id',
                    'firstname' => 'required|string',
                    'lastname' => 'required|string',
                    'age' => 'nullable|integer',
                    'gender' => 'nullable|string|in:male,female,other',
                ])->validate();

                $passengers[] = Passenger::create($validated);
            }
        } else {
            $validated = $request->validate([
                'reservation_id' => 'required|exists:reservations,id',
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'age' => 'nullable|integer',
                'gender' => 'nullable|string|in:male,female,other',
            ]);

            $passengers[] = Passenger::create($validated);
        }

        return response()->json([
            'message' => count($passengers) > 1 ? 'Passagers créés avec succès.' : 'Passager créé avec succès.',
            'data' => $passengers
        ], 201);
    }

    /**
     * Affiche un passager par ID
     */
    public function show($id)
    {
        $passenger = Passenger::findOrFail($id);
        return response()->json($passenger);
    }

    /**
     * Met à jour un passager
     */
    public function update(Request $request, $id)
    {
        $passenger = Passenger::findOrFail($id);

        $validated = $request->validate([
            'firstname' => 'sometimes|required|string',
            'lastname' => 'sometimes|required|string',
            'age' => 'nullable|integer',
            'gender' => 'nullable|string|in:male,female,other',
        ]);

        $passenger->update($validated);

        return response()->json(['message' => 'Passager mis à jour avec succès', 'data' => $passenger]);
    }

    /**
     * Supprime un passager
     */
    public function destroy($id)
    {
        $passenger = Passenger::findOrFail($id);
        $passenger->delete();

        return response()->json(['message' => 'Passager supprimé avec succès']);
    }
}
