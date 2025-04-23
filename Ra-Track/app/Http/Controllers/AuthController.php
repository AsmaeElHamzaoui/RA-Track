<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Inscription d'un nouvel utilisateur (API version)
     */

     public function showLoginForm()
{
    return view('login');
}

    

    /**
     * Inscription via formulaire HTML (WEB)
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'in:admin,maintenanceagent,pilot,client',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'] ?? 'client',
        ]);

        Auth::login($user);

        // Si une réservation est en attente en session
        if (session()->has('pending_reservation_id')) {
            $reservationId = session()->pull('pending_reservation_id');

            $reservation = Reservation::find($reservationId);
            if ($reservation && !$reservation->user_id) {
                $reservation->update(['user_id' => $user->id]);
            }

            return redirect()->route('payment.show', ['reservation' => $reservationId]);
        }

        // Redirection selon les réservations
        $reservation = Reservation::where('user_id', $user->id)->latest()->first();
        if ($reservation) {
            return redirect()->route('reservation.show', ['reservation' => $reservation->id]);
        }

        return redirect()->route('home');
    }

    /**
     * Connexion d’un utilisateur via formulaire HTML (WEB)
     */
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Si une réservation est en attente en session (non encore liée à un utilisateur)
        if (session()->has('pending_reservation_id')) {
            $reservationId = session()->pull('pending_reservation_id');

            $reservation = Reservation::find($reservationId);
            if ($reservation && !$reservation->user_id) {
                $reservation->update(['user_id' => $user->id]);
            }

            return redirect()->route('payments.index', ['reservation' => $reservationId]);
        }

        // Sinon, direction la page d’accueil
        return redirect()->route('home');
    }

    return back()->withErrors([
        'email' => 'Identifiants incorrects.',
    ]);
}


    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Déconnecté avec succès.');
    }
}
