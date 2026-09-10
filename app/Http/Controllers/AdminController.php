<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Diklat;
use App\Models\Penempatan;
use App\Models\JabatanStruktural;

class AdminController extends Controller
{
    /**
     * Menampilkan dashboard admin.
     */
    public function index()
    {
        // Statistik user
        $totalUsers = User::count();

        $totalClients = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->count();

        $totalAdmins = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->count();

        // Statistik data pegawai
        $totalJabatanStruktural = JabatanStruktural::count();

        $totalDiklat = Diklat::count();

        $totalPenempatan = Penempatan::count();

        // User terbaru
        $latestUsers = User::latest()
            ->take(5)
            ->get();

        return view('admin.index', [
            'title' => 'Dashboard',

            'totalUsers' => $totalUsers,
            'totalClients' => $totalClients,
            'totalAdmins' => $totalAdmins,

            'totalJabatanStruktural' => $totalJabatanStruktural,
            'totalDiklat' => $totalDiklat,
            'totalPenempatan' => $totalPenempatan,

            'latestUsers' => $latestUsers,
        ]);
    }
}