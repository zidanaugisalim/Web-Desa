<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\AnakController as ApiAnakController;
use Illuminate\Support\Facades\Route;

// API Routes
Route::get('/api/anak/perdesa', [ApiAnakController::class, 'perDesa'])->name('api.anak.perdesa');

// Rute utama
Route::get('/', function () {
    return view('awal');
})->name('home');

Route::get('/awal', function () {
    return view('awal');
})->name('awal');

// Rute untuk tamu (belum login)
Route::middleware('guest')->group(function () {
    // Rute Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    // Rute Registrasi
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    
    // Rute Lupa Password
    Route::get('/forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    
    // Rute Reset Password
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');
});

// Rute yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute untuk AnakController
    Route::resource('anak', AnakController::class);
    
    // Rute untuk StuntingController
    Route::resource('stuntings', \App\Http\Controllers\StuntingController::class);
    
    // Halaman input data (redirect ke form create anak)
    Route::get('/input', function () {
        return redirect()->route('anak.create');
    })->name('input');

    // Halaman welcome
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');

    // Rute untuk AnakController
    Route::prefix('anak')->group(function () {
        Route::get('/create', function () {
            return view('anak.create');
        })->name('anak.create');
        
        Route::post('/store', [AnakController::class, 'store'])->name('anak.store');
    });
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
