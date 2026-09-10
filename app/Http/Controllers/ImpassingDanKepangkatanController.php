<?php

namespace App\Http\Controllers;

use App\Models\ImpassingDanKepangkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class ImpassingDanKepangkatanController extends Controller
{
    /**
     * Mengambil daftar kolom tabel.
     */
    private function columns()
    {
        return Schema::getColumnListing(
            (new ImpassingDanKepangkatan)->getTable()
        );
    }

    /**
     * Menampilkan data impassing dan kepangkatan
     * milik user yang sedang login.
     */
    public function index()
    {
        $data = ImpassingDanKepangkatan::where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->get();

        return view('client.page.index', [
            'title' => 'Impassing dan Kepangkatan',
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
            'title' => 'Tambah Impassing dan Kepangkatan',
            'columns' => $this->columns(),
        ]);
    }

    /**
     * Menyimpan data impassing dan kepangkatan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Pangkat_atau_Golongan' => 'nullable|string|max:255',
            'No_SK'                => 'nullable|string|max:255',
            'Tanggal_SK'           => 'nullable|string|max:255',
            'Tanggal_Mulai'        => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();

        ImpassingDanKepangkatan::create($validated);

        return redirect()
            ->to(pageUrl('ImpassingDanKepangkatanController'))
            ->with(
                'success',
                'Data impassing dan kepangkatan berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan detail data.
     */
    public function show($id)
    {
        $data = ImpassingDanKepangkatan::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        return view('client.page.show', [
            'title' => 'Detail Impassing dan Kepangkatan',
            'data' => $data,
            'columns' => $this->columns(),
        ]);
    }

    /**
     * Menampilkan form edit.
     */
    public function edit($id)
    {
        $data = ImpassingDanKepangkatan::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        return view('client.page.edit', [
            'title' => 'Edit Impassing dan Kepangkatan',
            'data' => $data,
            'columns' => $this->columns(),
        ]);
    }

    /**
     * Mengupdate data impassing dan kepangkatan.
     */
    public function update(Request $request, $id)
    {
        $data = ImpassingDanKepangkatan::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        $validated = $request->validate([
            'Pangkat_atau_Golongan' => 'nullable|string|max:255',
            'No_SK'                => 'nullable|string|max:255',
            'Tanggal_SK'           => 'nullable|string|max:255',
            'Tanggal_Mulai'        => 'nullable|string|max:255',
        ]);

        $data->update($validated);

        return redirect()
            ->to(pageUrl('ImpassingDanKepangkatanController'))
            ->with(
                'success',
                'Data impassing dan kepangkatan berhasil diperbarui.'
            );
    }

    /**
     * Menghapus data impassing dan kepangkatan.
     */
    public function destroy($id)
    {
        $data = ImpassingDanKepangkatan::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        $data->delete();

        return redirect()
            ->to(pageUrl('ImpassingDanKepangkatanController'))
            ->with(
                'success',
                'Data impassing dan kepangkatan berhasil dihapus.'
            );
    }
}