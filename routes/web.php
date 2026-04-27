<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

// Halaman Login
Route::get('/', [PageController::class, 'login'])->name('login');

// Proses Login
Route::post('/login', [PageController::class, 'prosesLogin'])->name('proses.login');

// Dashboard
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

// Pengelolaan Data
Route::get('/pengelolaan', [PageController::class, 'pengelolaan'])->name('pengelolaan');

// Tambah Motor
Route::post('/pengelolaan/tambah-motor', [PageController::class, 'tambahMotor'])->name('tambah.motor');

// Profile
Route::get('/profile', [PageController::class, 'profile'])->name('profile');

// Logout
Route::get('/logout', [PageController::class, 'logout'])->name('logout');
