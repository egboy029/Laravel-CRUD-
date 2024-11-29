<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Staff Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [EventController::class, 'index'])->name('staff.home');
    
    // Trash management routes
    Route::get('/events/trash', [EventController::class, 'trash'])->name('events.trash');
    Route::post('/events/{id}/restore', [EventController::class, 'restore'])->name('events.restore');
    Route::delete('/events/{id}/force-delete', [EventController::class, 'forceDelete'])->name('events.force-delete');
    
    // Regular event routes
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});
