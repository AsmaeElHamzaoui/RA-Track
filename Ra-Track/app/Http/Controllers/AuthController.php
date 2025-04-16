<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Inscription d'un nouvel utilisateur
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'in:admin,maintenanceagent,pilot,client', // Vérification du rôle
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'] ?? 'client', // Par défaut, rôle client
        ]);

        // Création du token d'authentification
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function store(Request $request)
    {
        // Logique d'inscription Laravel classique
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'in:admin,maintenanceagent,pilot,client', // Vérification du rôle
        ]);
    
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role'] ?? 'client', // Par défaut, rôle client
        ]);
    
        Auth::login($user);
    
        // Récupérer une réservation stockée en session
        if (session()->has('pending_reservation_id')) {
            $reservationId = session()->pull('pending_reservation_id');
    
            // Attacher l'utilisateur à la réservation
            $reservation = Reservation::find($reservationId);
            if ($reservation && !$reservation->user_id) {
                $reservation->update(['user_id' => $user->id]);
            }
    
            // Rediriger vers la page de paiement
            return redirect()->route('payment.show', ['reservation' => $reservationId]);
        }
    
        // Redirection normale
        return redirect()->route('dashboard'); // ou une autre route par défaut
    }
    
    
      /**
     * Connexion d'un utilisateur
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Vérification des identifiants
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Création du token d'authentification
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'User logged in successfully',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    /**
     * Déconnexion de l'utilisateur (révocation du token)
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'User logged out successfully'
        ]);
    }
}
