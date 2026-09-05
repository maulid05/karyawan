<?php

namespace App\Http\Controllers;

use App\Models\ProfilAkademik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilAkademikController extends Controller
{
    /**
     * Menampilkan profil akademik.
     */
    public function index()
    {
        $profilAkademik = ProfilAkademik::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        return view('profil-akademik.index', compact('profilAkademik'));
    }

    /**
     * Menampilkan form edit.
     */
    public function edit()
    {
        $profilAkademik = ProfilAkademik::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        return view('profil-akademik.edit', compact('profilAkademik'));
    }

    /**
     * Menyimpan perubahan profil akademik.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'rumpun_ilmu' => 'nullable|string|max:255',
            'pohon_ilmu' => 'nullable|string|max:255',
            'kelompok_ilmu' => 'nullable|string|max:255',
            'cabang_ilmu' => 'nullable|string|max:255',

            'scopus_id' => 'nullable|string|max:255',
            'scopus_link' => 'nullable|url|max:255',
            'scopus_h_index' => 'nullable|integer|min:0',

            'google_scholar_id' => 'nullable|string|max:255',
            'google_scholar_link' => 'nullable|url|max:255',
            'google_scholar_h_index' => 'nullable|integer|min:0',

            'orcid_id' => 'nullable|string|max:255',
            'orcid_link' => 'nullable|url|max:255',

            'repository_universitas' => 'nullable|url|max:255',
        ]);

        $profilAkademik = ProfilAkademik::firstOrCreate(
            ['user_id' => Auth::id()]
        );

        $profilAkademik->update($validated);

        return redirect()
            ->route('profil-akademik.index')
            ->with('success', 'Profil akademik berhasil diperbarui.');
    }
}