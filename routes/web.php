<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\FakultasController;
use App\Http\Controllers\admin\JurusanController;
use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'action_login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Fakultas routes
    Route::get('/fakultas', [FakultasController::class, 'index'])->name('fakultas.index');
    Route::post('/fakultas', [FakultasController::class, 'store'])->name('fakultas.store');

    Route::post('/fakultas/{fakultas}/update', [FakultasController::class, 'update'])->name('fakultas.update');

    Route::get('/fakultas/{fakultas}/destroy', [FakultasController::class, 'destroy'])->name('fakultas.destroy');

    // Jurusan routes
    Route::get('/jurusan/{fakultas}', [JurusanController::class, 'index'])->name('jurusan.index');
    Route::post('/jurusan/{fakultas}', [JurusanController::class, 'store'])->name('jurusan.store');

    Route::post('/jurusan/{fakultas}/{jurusan}/update', [JurusanController::class, 'update'])->name('jurusan.update');
    
    Route::get('/jurusan/{fakultas}/{jurusan}/destroy', [JurusanController::class, 'destroy'])->name('jurusan.destroy');

    // Logout routes
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
