<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaneController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PassengerController;


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



// routes passengers
Route::get('/passengers', [PassengerController::class, 'index']);        // Lire tous les passagers
Route::post('/passengers', [PassengerController::class, 'store'])->name('passenger.store'); // Créer un nouveau passager
Route::get('/passengers/{id}', [PassengerController::class, 'show']);    // Lire un passager spécifique
Route::put('/passengers/{id}', [PassengerController::class, 'update']);  // Mettre à jour un passager
Route::delete('/passengers/{id}', [PassengerController::class, 'destroy']); // Supprimer un passager



// Protéger ces routes avec l'authentification
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('reservations', ReservationController::class);
    // Assure-toi que les routes pour les passagers existent aussi
    // Route::apiResource('passengers', PassengerController::class)->except(['create', 'edit']); // Si c'est une API
});