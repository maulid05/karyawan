<?php

namespace App\Http\Controllers;

use App\Models\Penempatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class PenempatanController extends Controller
{
    /**
     * Mengambil daftar kolom tabel.
     */
    private function columns()
    {
        return Schema::getColumnListing(
            (new Penempatan)->getTable()
        );
    }

    /**
     * Menampilkan data penempatan
     * milik user yang sedang login.
     */
    public function index()
    {
        $data = Penempatan::where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->get();

        return view('client.page.index', [
            'title' => 'Penempatan',
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
            'title' => 'Tambah Penempatan',
            'columns' => $this->columns(),
        ]);
    }

    /**
     * Menyimpan data penempatan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Status'               => 'nullable|string|max:255',
            'Ikatan_Kerja'         => 'nullable|string|max:255',
            'Jenjang_Pendidikan'   => 'nullable|string|max:255',
            'Perguruan_Tinggi'     => 'nullable|string|max:255',
            'Unit'                 => 'nullable|string|max:255',
            'Taggal_Mulai'         => 'nullable|string|max:255',
            'Taggal_Surat_Terbit'  => 'nullable|string|max:255',
            'Penugasan'            => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();

        Penempatan::create($validated);

        return redirect()
            ->to(pageUrl('PenempatanController'))
            ->with(
                'success',
                'Data penempatan berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan detail data.
     */
    public function show($id)
    {
        $data = Penempatan::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        return view('client.page.show', [
            'title' => 'Detail Penempatan',
            'data' => $data,
            'columns' => $this->columns(),
        ]);
    }

    /**
     * Menampilkan form edit.
     */
    public function edit($id)
    {
        $data = Penempatan::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        return view('client.page.edit', [
            'title' => 'Edit Penempatan',
            'data' => $data,
            'columns' => $this->columns(),
        ]);
    }

    /**
     * Mengupdate data penempatan.
     */
    public function update(Request $request, $id)
    {
        $data = Penempatan::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        $validated = $request->validate([
            'Status'               => 'nullable|string|max:255',
            'Ikatan_Kerja'         => 'nullable|string|max:255',
            'Jenjang_Pendidikan'   => 'nullable|string|max:255',
            'Perguruan_Tinggi'     => 'nullable|string|max:255',
            'Unit'                 => 'nullable|string|max:255',
            'Taggal_Mulai'         => 'nullable|string|max:255',
            'Taggal_Surat_Terbit'  => 'nullable|string|max:255',
            'Penugasan'            => 'nullable|string|max:255',
        ]);

        $data->update($validated);

        return redirect()
            ->to(pageUrl('PenempatanController'))
            ->with(
                'success',
                'Data penempatan berhasil diperbarui.'
            );
    }

    /**
     * Menghapus data penempatan.
     */
    public function destroy($id)
    {
        $data = Penempatan::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        $data->delete();

        return redirect()
            ->to(pageUrl('PenempatanController'))
            ->with(
                'success',
                'Data penempatan berhasil dihapus.'
            );
    }
}