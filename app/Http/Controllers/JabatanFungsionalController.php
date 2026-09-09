<?php

namespace App\Http\Controllers;

use App\Models\JabatanFungsional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JabatanFungsionalController extends Controller
{
    /**
     * Menampilkan data jabatan fungsional
     * milik user yang sedang login.
     */
    public function index()
    {
        $data = JabatanFungsional::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('jabatan_fungsional.index', compact('data'));
    }

    /**
     * Menampilkan form tambah data.
     */
    public function create()
    {
        return view('jabatan_fungsional.create');
    }

    /**
     * Menyimpan data jabatan fungsional.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Jabantan_Fungsional' => 'nullable|string|max:255',
            'No_SK'               => 'nullable|string|max:255',
            'Tanggal_Masuk'       => 'nullable|string|max:255',
            'Status_Pegawai'      => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();

        JabatanFungsional::create($validated);

        return redirect()
            ->route('jabatan-fungsional.index')
            ->with('success', 'Data jabatan fungsional berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit.
     */
    public function edit($id)
    {
        $data = JabatanFungsional::where('user_id', Auth::id())
            ->findOrFail($id);

        return view('jabatan_fungsional.edit', compact('data'));
    }

    /**
     * Mengupdate data jabatan fungsional.
     */
    public function update(Request $request, $id)
    {
        $data = JabatanFungsional::where('user_id', Auth::id())
            ->findOrFail($id);

        $validated = $request->validate([
            'Jabantan_Fungsional' => 'nullable|string|max:255',
            'No_SK'               => 'nullable|string|max:255',
            'Tanggal_Masuk'       => 'nullable|string|max:255',
            'Status_Pegawai'      => 'nullable|string|max:255',
        ]);

        $data->update($validated);

        return redirect()
            ->route('jabatan-fungsional.index')
            ->with('success', 'Data jabatan fungsional berhasil diperbarui.');
    }

    /**
     * Menghapus data jabatan fungsional.
     */
    public function destroy($id)
    {
        $data = JabatanFungsional::where('user_id', Auth::id())
            ->findOrFail($id);

        $data->delete();

        return redirect()
            ->route('jabatan-fungsional.index')
            ->with('success', 'Data jabatan fungsional berhasil dihapus.');
    }
}