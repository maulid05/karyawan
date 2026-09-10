<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    SuperAdminController,
    AdminController,
    ClientController,
    AuthController,
    DataPribadiController,
    KepegawaianController,
    KependudukanController,
    KeluargaController,
    KontakController,
    ProfilAkademikController,
    LainLainController,
    PasFotoController,
    MasterJabatanController,
    MasterUnitController,
    PageController
};

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('index', [
        SuperAdminController::class,
        'index'
    ])->name('superadmin');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', [
        AdminController::class,
        'index'
    ])->name('dashboard');

    Route::resource('master-jabatan', MasterJabatanController::class);
    Route::resource('master-unit', MasterUnitController::class);
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

    Route::patch('profil-akademik/update/{id}', [
        ProfilAkademikController::class,
        'update'
    ])->name('profil-akademik.update');

    Route::patch('lain-lain/update/{id}', [
        LainLainController::class,
        'update'
    ])->name('lain-lain.update');

    Route::patch('pas-foto/update/{id}', [
        PasFotoController::class,
        'update'
    ])->name('pas-foto.update');

    Route::get(
        '/',
        [PageController::class, 'index']
    )->name('home');

    Route::match(
        ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'],
        '/page',
        [PageController::class, 'page']
    )->name('page');

});