<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ==========================================
// 1. ESPACE ÉTUDIANT (W ay wahed connecté)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function(){

    // Dashboard dyal l-Étudiant (Smaynah 'dashboard' 3la 9bal Breeze)
    Route::get('/dashboard', function () {
        $events = Event::where('date', '>=', now()->toDateString())
                       ->orderBy('date', 'asc')
                       ->get();

        return view('dashboard_student', compact('events'));

    })->name('dashboard');
 Route::resource('/reservations', ReservationController::class);
    // Les routes dyal Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// 2. ESPACE ADMIN (M7mi b is_admin)
// ==========================================
Route::middleware(['auth', 'is_admin'])->group(function () {

    // Dashboard dyal l-Admin dynamique (Kay-jbed les events mn EventController)
    Route::get('/dashboard_admin', [EventController::class, 'index'])->name('admin.dashboard');

    // Routes dyal l-création, modification, etc.
    Route::resource('/events', EventController::class);

});

require __DIR__.'/auth.php';
