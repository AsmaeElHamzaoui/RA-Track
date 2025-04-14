<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;

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
Route::get('/dashboard', [DashboardController::class, 'showDashboard']);
Route::get('/bookingAirplane', [BookingController::class, 'showBooking'])->name('booking');

