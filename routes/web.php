<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BusController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\TransactionController;
// Halaman Utama / Landing Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Proses Pencarian Tiket Bus
Route::get('/search', [HomeController::class, 'search'])->name('tickets.search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Bagian ini sudah diperbaiki dari $table->delete menjadi Route::delete
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); 
});

// Proses Pencarian Tiket Bus
Route::get('/search', [HomeController::class, 'search'])->name('tickets.search');

// Detail Jadwal & Pilih Kursi (Tambahkan baris ini)
Route::get('/tickets/{id}', [HomeController::class, 'show'])->name('tickets.show');
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Rute CRUD untuk Admin LokaBus
    Route::resource('buses', BusController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('transactions', TransactionController::class);
});
require __DIR__.'/auth.php';