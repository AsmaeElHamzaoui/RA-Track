<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaneController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\Auth\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// routes authentication
Route::post('register', [AuthController::class, 'register']);  // Route pour l'inscription
Route::post('login', [AuthController::class, 'login']);        // Route pour la connexion
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // Route pour la déconnexion


// routes planes
Route::get('/planes', [PlaneController::class, 'index']);
Route::get('/planes/{id}', [PlaneController::class, 'show']);
Route::post('/planes', [PlaneController::class, 'store']);
Route::put('/planes/{id}', [PlaneController::class, 'update']);
Route::delete('/planes/{id}', [PlaneController::class, 'destroy']);

//routes airports
Route::get('/airports', [AirportController::class, 'index']);
Route::get('/airports/{id}', [AirportController::class, 'show']);
Route::post('/airports', [AirportController::class, 'store']);
Route::put('/airports/{id}', [AirportController::class, 'update']);
Route::delete('/airports/{id}', [AirportController::class, 'destroy']);

//routes flights
Route::get('/flights', [FlightController ::class, 'index']);
Route::get('/flights/{id}', [FlightController ::class, 'show'])->name('flights.show');
Route::post('/flights', [FlightController ::class, 'store']);
Route::put('/flights/{id}', [FlightController ::class, 'update']);
Route::delete('/flights/{id}', [FlightController ::class, 'destroy']);

//routes reservations
Route::get('/reservation/{flight}', [ReservationController::class, 'show'])->name('reservation.show');
Route::post('/reservation', [ReservationController::class, 'submit'])->name('reservation.submit');

// routes passengers
Route::get('/passengers', [PassengerController::class, 'index']);        // Lire tous les passagers
Route::post('/passengers', [PassengerController::class, 'store']);       // Créer un nouveau passager
Route::get('/passengers/{id}', [PassengerController::class, 'show']);    // Lire un passager spécifique
Route::put('/passengers/{id}', [PassengerController::class, 'update']);  // Mettre à jour un passager
Route::delete('/passengers/{id}', [PassengerController::class, 'destroy']); // Supprimer un passager