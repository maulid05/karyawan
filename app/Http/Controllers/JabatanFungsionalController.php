<?php

namespace App\Http\Controllers;

use App\Models\JabatanFungsional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class JabatanFungsionalController extends Controller
{
    /**
     * Mengambil daftar kolom tabel.
     */
    private function columns()
    {
        return Schema::getColumnListing(
            (new JabatanFungsional)->getTable()
        );
    }

    /**
     * Menampilkan data jabatan fungsional
     * milik user yang sedang login.
     */
    public function index()
    {
        $data = JabatanFungsional::where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->get();

        return view('client.page.index', [
            'title' => 'Jabatan Fungsional',
            'data' => $data,
            'columns' => $this->columns(),
        ]);
    }

    /**
     * Menampilkan form tambah data.
     */
    public function create()
    {
        return view('client.page.create', [
            'title' => 'Tambah Jabatan Fungsional',
            'columns' => $this->columns(),
        ]);
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
            ->to(pageUrl('JabatanFungsionalController'))
            ->with(
                'success',
                'Data jabatan fungsional berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan detail data.
     */
    public function show($id)
    {
        $data = JabatanFungsional::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        return view('client.page.show', [
            'title' => 'Detail Jabatan Fungsional',
            'data' => $data,
            'columns' => $this->columns(),
        ]);
    }

    /**
     * Menampilkan form edit.
     */
    public function edit($id)
    {
        $data = JabatanFungsional::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        return view('client.page.edit', [
            'title' => 'Edit Jabatan Fungsional',
            'data' => $data,
            'columns' => $this->columns(),
        ]);
    }

    /**
     * Mengupdate data jabatan fungsional.
     */
    public function update(Request $request, $id)
    {
        $data = JabatanFungsional::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        $validated = $request->validate([
            'Jabantan_Fungsional' => 'nullable|string|max:255',
            'No_SK'               => 'nullable|string|max:255',
            'Tanggal_Masuk'       => 'nullable|string|max:255',
            'Status_Pegawai'      => 'nullable|string|max:255',
        ]);

        $data->update($validated);

        return redirect()
            ->to(pageUrl('JabatanFungsionalController'))
            ->with(
                'success',
                'Data jabatan fungsional berhasil diperbarui.'
            );
    }

    /**
     * Menghapus data jabatan fungsional.
     */
    public function destroy($id)
    {
        $data = JabatanFungsional::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        $data->delete();

        return redirect()
            ->to(pageUrl('JabatanFungsionalController'))
            ->with(
                'success',
                'Data jabatan fungsional berhasil dihapus.'
            );
    }
}