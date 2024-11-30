<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminEventController;

Route::get('/', function () {
    return view('welcome');
});

// Redirect /dashboard to the appropriate route based on user role
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('staff.home');
})->middleware(['auth'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminEventController::class, 'dashboard'])->name('admin.dashboard');
    
    // Admin Event Management
    Route::get('/admin/events', [AdminEventController::class, 'index'])->name('admin.events.index');
    Route::post('/admin/events', [AdminEventController::class, 'store'])->name('admin.events.store');
    Route::get('/admin/events/{event}/edit', [AdminEventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/admin/events/{event}', [AdminEventController::class, 'update'])->name('admin.events.update');
    Route::delete('/admin/events/{event}', [AdminEventController::class, 'destroy'])->name('admin.events.destroy');
    
    // Trash management routes
    Route::get('/events/trash', [AdminEventController::class, 'trash'])->name('events.trash');
    Route::post('/events/{id}/restore', [AdminEventController::class, 'restore'])->name('events.restore');
    Route::delete('/events/{id}/force-delete', [AdminEventController::class, 'forceDelete'])->name('events.force-delete');
});

// Staff Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [EventController::class, 'index'])->name('staff.home');
    
    // Regular event routes
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});
