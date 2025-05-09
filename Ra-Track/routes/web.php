<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DashboardPilotController;
use App\Http\Controllers\FlightReportController;
use App\Http\Controllers\DashboardAgentController;
use App\Http\Controllers\MaintenanceController;

// route home page
Route::get('/', [HomeController::class, 'showBooking'])->name('home');

// route about page
Route::get('/about', function () { return view('about');});

// route services page
Route::get('/services', function () { return view('services');});

// route register page
Route::get('/register', function () { return view('register');});

// routes authentication
Route::post('/register', [AuthController::class, 'register'])->name('register'); 
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login'); 

//routes dashboard admin
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboardAdmin');
Route::get('/bookingAirplane', [BookingController::class, 'showBooking'])->name('booking');

// routes dashboard pilot
Route::get('/dashboardPilot', [DashboardPilotController::class, 'showDashboard'])->name('dashboardPilot');

// routes dashboard agent
Route::get('/dashboardAgent', [DashboardAgentController::class, 'showDashboard'])->name('dashboardAgent');

//routes reservations
Route::get('/reservation/{flight}', [ReservationController::class, 'show'])->name('reservation.show');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation');
Route::put('/reservation/{id}', [ReservationController::class, 'update']);  
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy']);


// routes payments
Route::get('/payments/{reservation}', [PaymentController::class, 'index'])->name('payments.index')->middleware('auth');
Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
Route::get('/payments/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
Route::delete('/payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
Route::get('/checkout/{reservation}', [PaymentController::class, 'checkout'])->name('stripe.checkout');
Route::get('/payment-success/{id}', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment-cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

// Route pour la page de confirmation après paiement
Route::get('/reservation/{reservation}/confirmation', [ReservationController::class, 'showConfirmation'])
     ->name('reservation.confirmation')
     ->middleware('auth'); 

// Route pour afficher la page de réservations personnelles
Route::get('/myreservations', [ReservationController::class, 'showPersonalReservation'])
     ->name('personal.reservation')
     ->middleware('auth'); 

// Route pour télécharger le ticket d'un passager spécifique
Route::get('/ticket/{passenger}/download', [TicketController::class, 'downloadTicket'])
     ->name('ticket.download')
     ->middleware('auth'); 

// routes flight reports 
Route::get('/flight-reports', [FlightReportController::class, 'index'])->name('flight-reports.index');
Route::post('/flight-reports', [FlightReportController::class, 'store'])->name('flight-reports.store');
Route::get('/flight-reports/{id}', [FlightReportController::class, 'show'])->name('flight-reports.show');
Route::put('/flight-reports/{id}', [FlightReportController::class, 'update'])->name('flight-reports.update');
Route::delete('/flight-reports/{id}', [FlightReportController::class, 'destroy'])->name('flight-reports.destroy');

// routes maintenance
Route::get('/maintenances', [MaintenanceController::class, 'index'])->name('maintenances.index');
Route::post('/maintenances', [MaintenanceController::class, 'store'])->name('maintenances.store');
Route::get('/maintenances/{maintenance}', [MaintenanceController::class, 'show'])->name('maintenances.show');
Route::put('/maintenances/{maintenance}', [MaintenanceController::class, 'update'])->name('maintenances.update');
Route::delete('/maintenances/{maintenance}', [MaintenanceController::class, 'destroy'])->name('maintenances.destroy');


Route::get('/real-timeTracking', function () {
     return view('real-timeTracking');
 });

 



    
