<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Redirect halaman utama ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route khusus pengguna yang belum login (Guest)
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register Routes (Penambahan Baru)
    Route::get('/register', [AuthController::class, 'showregister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Route khusus pengguna yang sudah login (Authenticated)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
});
