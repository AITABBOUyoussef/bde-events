<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {

    // Les routes  Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// ==========================================
// 1. ESPACE ÉTUDIANT
// ==========================================
Route::middleware(['auth', 'is_student'])->group(function () {
    Route::get('/dashboard', [ReservationController::class, 'index'])->name('dashboard');
    Route::resource('/reservations', ReservationController::class);
    Route::get('/my-tickets', [ReservationController::class, 'myTickets'])->name('my.tickets');
});

// ==========================================
// 2. ESPACE ADMIN
// ==========================================
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/dashboard_admin', [EventController::class, 'index'])->name('admin.dashboard');
    Route::resource('/events', EventController::class);
});

require __DIR__ . '/auth.php';
