<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    SuperAdminController,
    AdminController,
    ClientController,
    AuthController,
    DataPribadiController,
    KependudukanController,
    KeluargaController,
    KontakController
};

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('index', [
        SuperAdminController::class,
        'index'
    ])->name('home');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('homepage', [
        ClientController::class,
        'index'
    ])->name('homepage');
});

Route::middleware('auth')->group(function () {
    Route::get('/cek/{id}', [
        AuthController::class,
        'show'
    ])->name('cek');

    Route::get('show/{id}', [
        DataPribadiController::class,
        'show'
    ])->name('profile');

    Route::patch('profil/update/{id}', [
        DataPribadiController::class,
        'update'
    ])->name('profil.update');

    Route::patch('kependudukan/update/{id}', [
        KependudukanController::class,
        'update'
    ])->name('kependudukan.update');

    Route::patch('keluarga/update/{id}', [
        KeluargaController::class,
        'update'
    ])->name('keluarga.update');

    Route::patch('kontak/update/{id}', [
        KontakController::class,
        'update'
    ])->name('kontak.update');

    Route::patch('kepegawaian/update/{id}', [
        KepegawaianController::class,
        'update'
    ])->name('kepegawaian.update');
});