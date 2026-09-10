<?php

namespace App\Http\Controllers;

use App\Models\MasterJabatan;
use Illuminate\Http\Request;

class MasterJabatanController extends Controller
{
    /**
     * Menampilkan daftar master jabatan.
     */
    public function index()
    {
        $data = MasterJabatan::latest()->get();

        return view('admin.masterJabatan.index', [
            'title' => 'Master Jabatan',
            'data' => $data,
        ]);
    }

    /**
     * Menampilkan form tambah jabatan.
     */
    public function create()
    {
        return view('admin.masterJabatan.create', [
            'title' => 'Tambah Jabatan',
        ]);
    }

    /**
     * Menyimpan jabatan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama_Jabatan' => 'required|string|max:255',
            'Jenis_Jabatan' => 'nullable|string|max:255',
            'Status' => 'nullable|string|max:255',
        ]);

        MasterJabatan::create($validated);

        return redirect()
            ->to(pageUrl('MasterJabatanController'))
            ->with(
                'success',
                'Master jabatan berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan detail jabatan.
     */
    public function show($id)
    {
        $data = MasterJabatan::findOrFail($id);

        return view('admin.masterJabatan.show', [
            'title' => 'Detail Master Jabatan',
            'data' => $data,
        ]);
    }

    /**
     * Menampilkan form edit jabatan.
     */
    public function edit($id)
    {
        $data = MasterJabatan::findOrFail($id);

        return view('admin.masterJabatan.edit', [
            'title' => 'Edit Master Jabatan',
            'data' => $data,
        ]);
    }

    /**
     * Mengupdate jabatan.
     */
    public function update(Request $request, $id)
    {
        $data = MasterJabatan::findOrFail($id);

        $validated = $request->validate([
            'Nama_Jabatan' => 'required|string|max:255',
            'Jenis_Jabatan' => 'nullable|string|max:255',
            'Status' => 'nullable|string|max:255',
        ]);

        $data->update($validated);

        return redirect()
            ->to(pageUrl('MasterJabatanController'))
            ->with(
                'success',
                'Master jabatan berhasil diperbarui.'
            );
    }

    /**
     * Menghapus jabatan.
     */
    public function destroy($id)
    {
        $data = MasterJabatan::findOrFail($id);

        $data->delete();

        return redirect()
            ->to(pageUrl('MasterJabatanController'))
            ->with(
                'success',
                'Master jabatan berhasil dihapus.'
            );
    }
}