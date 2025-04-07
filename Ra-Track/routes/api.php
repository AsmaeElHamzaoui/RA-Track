<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaneController;
use App\Http\Controllers\AirportController;


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

