<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{SuperAdminController, AdminController, ClientController, AuthController};

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [
    AuthController::class,
    'home'
])->name('home');

Route::middleware(['auth', 'role:superadmin'])->group(function () {

    Route::get('index', [
        SuperAdminController::class,
        'index'
    ])->name('index');
});
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('dashboard', function(){
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth', 'role:client'])->group(function(){
    Route::get('homepage', ClientController::class . '@index')->name('homepage');   
});