<?php

namespace App\Http\Controllers;
use App\Models\Flight;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
   
    public function show($id)
    {
        $flight = Flight::with(['departureAirport', 'arrivalAirport'])->findOrFail($id);
        return view('reservation.show', compact('flight'));
    }

    public function submit(Request $request)
{
    
}
}
