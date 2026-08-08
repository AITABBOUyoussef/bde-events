<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ReservationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
// ==========================================
// 1. ESPACE ÉTUDIANT
// ==========================================
Route::middleware(['is_student'])->group(function () {

     Route::get('/reservations', [ReservationController::class, 'index']);

});
// ==========================================
// 2. ESPACE ADMIN
// ==========================================
Route::middleware(['is_admin'])->group(function () {
     Route::get('/events', [EventController::class, 'index']);
     Route::post('/add-event', [EventController::class, 'store']);

});

});







