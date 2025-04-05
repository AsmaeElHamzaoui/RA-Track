<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AirportController extends Controller
{
    /**
     * Afficher la liste des aéroports.
     */
    public function index()
    {
        return response()->json(Airport::all(), Response::HTTP_OK);
    }

  
}
