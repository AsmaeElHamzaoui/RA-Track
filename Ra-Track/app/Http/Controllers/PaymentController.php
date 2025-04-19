<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    
   
    public function index(Reservation $reservation)
    {
        // Vérifie que la réservation appartient à l'utilisateur connecté
        if ($reservation->user_id !== Auth::id()) {
            abort(403, 'Accès non autorisé à cette réservation.');
        }

        // Charge les passagers et le vol avec eager loading
        $reservation->load('passengers', 'flight');

        return view('payments', compact('reservation'));
    }

}
