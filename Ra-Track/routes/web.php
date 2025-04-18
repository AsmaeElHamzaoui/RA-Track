<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;

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

Route::get('/', [HomeController::class, 'showBooking'])->name('home');

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
Route::post('/register', [AuthController::class, 'store'])->name('register'); // version HTML
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); // conserve celle-ci uniquement

//routes dashboard
Route::get('/dashboard', [DashboardController::class, 'showDashboard']);
Route::get('/bookingAirplane', [BookingController::class, 'showBooking'])->name('booking');


//routes reservations
Route::get('/reservation/{flight}', [ReservationController::class, 'show'])->name('reservation.show');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation');
Route::put('/reservation/{id}', [ReservationController::class, 'update']);  
Route::delete('/reservation/{id}', [ReservationController::class, 'destroy']);
Route::get('/payment/{reservation}', [PaymentController::class, 'show'])->name('payment.show');


Route::get('/real-timeTracking', function () {
    return view('real-timeTracking');
});

Route::get('/payments', function () {
    return view('payments');
});

Route::get('/pdfReceipt', function () {
    return view('pdfReceipt');
});




Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('payments.show');
Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
Route::put('/payments/{id}', [PaymentController::class, 'update'])->name('payments.update');
Route::delete('/payments/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');
