<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{SuperAdminController, AdminController, ClientController, AuthController, DataPribadiController};

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    //dd('halo');
    Route::get('index', [
        SuperAdminController::class,
        'index'
    ])->name('home');
});

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('dashboard', function(){
        return view('dashboard');
    });
});

Route::middleware(['auth', 'role:client'])->group(function(){
    Route::get('homepage', ClientController::class . '@index');   
});

Route::middleware('auth')->group(function () {
    Route::get('/cek/{id}', [AuthController::class, 'show'])->name('cek');
    Route::get('show/{id}', [DataPribadiController::class, 'show'])->name('profile');
    Route::patch('update/profil', [DataPribadiController::class, 'update']);
});