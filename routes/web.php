<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard_Admin', function () {
    return view('dashboard_Admin');
})->middleware(['auth', 'verified'])->name('dashboard_Admin');

// Route::middleware(['auth' , 'is_admin'])->prefix('admin')->group(function (){
// Route::get('/admin/dashboard', function () {
//     return 'sddddddddd';
// })->name('dashboard_admin');

// });

Route::middleware(['auth' , 'is_admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('/events', EventController::class);


});

require __DIR__.'/auth.php';
