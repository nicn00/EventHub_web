<?php

use Illuminate\Support\Facades\Route;

// --- Import semua Controller ---
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\User\TicketController;
use App\Http\Controllers\User\CalendarController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\EventController as AdminEvent;
use App\Http\Controllers\Admin\UserController as AdminUser;

/*
|--------------------------------------------------------------------------
| 1. RUTE PUBLIK (Bisa diakses Guest, User, Admin)
|--------------------------------------------------------------------------
| (KF-03, KF-04)
*/
Route::get('/events', [PublicEventController::class, 'index'])->name('events.index');
Route::get('/', [PublicEventController::class, 'index'])->name('home');
Route::get('/event/{event}', [PublicEventController::class, 'show'])->name('events.show');


/*
|--------------------------------------------------------------------------
| 2. RUTE AUTENTIKASI (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| 3. RUTE PROFIL (Bisa diakses User & Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| 4. RUTE KHUSUS USER (WAJIB LOGIN + ROLE USER)
|--------------------------------------------------------------------------
| Ini adalah perbaikannya. Admin tidak bisa masuk ke sini.
*/
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    // Halaman "Tiket Saya" (KF-06)
    Route::get('/my-tickets', [TicketController::class, 'index'])->name('tickets.index');

    // Aksi Membeli Tiket (KF-05)
    Route::post('/buy-ticket/{event}', [TicketController::class, 'store'])->name('tickets.buy');

    // --- MEMBATALKAN TIKET ---
    Route::delete('/my-tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy');

    // --- TAMBAHKAN 2 RUTE INI (KF-07) ---
    Route::get('/my-calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar-feed', [CalendarController::class, 'feed'])->name('calendar.feed');
});


/*
|--------------------------------------------------------------------------
| 5. RUTE KHUSUS ADMIN (WAJIB LOGIN + ROLE ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    
    // Dashboard Admin (KF-09)
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    
    // Manajemen Event (KF-08)
    Route::resource('events', AdminEvent::class);
    
    // Manajemen User (KF-10)
    Route::resource('users', AdminUser::class)->only(['index', 'edit', 'update']);
});