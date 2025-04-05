<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    /**
     * Afficher la liste de tous les avions.
     */
    public function index()
    {
        $planes = Plane::with('flights', 'flightTrackings')->get();
        return response()->json($planes);
    }

  
}
