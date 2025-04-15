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

   
}
