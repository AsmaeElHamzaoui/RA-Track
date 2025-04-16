<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'showBooking']);

Route::get('/about', function () {
    return view('about');
});

Route::get('/services', function () {
    return view('services');
});

Route::get('/register', function () {
    return view('register');
});

// routes authentication
Route::post('register', [AuthController::class, 'register'])->name('register');  // Route pour l'inscription
Route::post('login', [AuthController::class, 'login']);        // Route pour la connexion
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // Route pour la déconnexion


Route::get('/login', function () {
    return view('login');
});

Route::get('/real-timeTracking', function () {
    return view('real-timeTracking');
});

Route::get('/payments', function () {
    return view('payments');
});

Route::get('/pdfReceipt', function () {
    return view('pdfReceipt');
});

Route::get('/reservation', function () {
    return view('reservation');
});

Route::get('/dashboard', [DashboardController::class, 'showDashboard']);
Route::get('/bookingAirplane', [BookingController::class, 'showBooking'])->name('booking');


//routes reservations
Route::get('/reservation/{flight}', [ReservationController::class, 'show'])->name('reservation.show');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation');
// Route::get('/reservation/{id}', [ReservationController::class, 'show']);    
Route::put('/reservation/{id}', [ReservationController::class, 'update']);  
Route::delete('/reservation/{id}', [ReservationController::class, 'destroy']);

