<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class RiwayatPekerjaanController extends Controller
{
    /**
     * Mengambil daftar kolom tabel.
     */
    private function columns()
    {
        return Schema::getColumnListing(
            (new RiwayatPekerjaan)->getTable()
        );
    }


    /**
     * Menampilkan seluruh riwayat pekerjaan
     * milik user yang sedang login.
     */
    public function index()
    {
        $data = RiwayatPekerjaan::where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->get();

        return view('client.page.index', [
            'title' => 'Riwayat Pekerjaan',
            'data' => $data,
            'columns' => $this->columns(),
        ]);
    }


    /**
     * Form tambah data.
     */
    public function create()
    {
        return view('client.page.create', [
            'title' => 'Riwayat Pekerjaan',
            'columns' => $this->columns(),
        ]);
    }


    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama_Pekerjaan' =>
                'nullable|string|max:255',

            'Rincian_Pekerjaan' =>
                'nullable|string|max:255',

            'Waktu' =>
                'nullable|string|max:255',

            'LN_atau_DN' =>
                'nullable|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();

        RiwayatPekerjaan::create(
            $validated
        );

        return redirect()
            ->to(
                pageUrl(
                    'RiwayatPekerjaanController'
                )
            )
            ->with(
                'success',
                'Riwayat pekerjaan berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail data.
     */
    public function show($id)
    {
        $data = RiwayatPekerjaan::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        return view('client.page.show', [
            'title' => 'Detail Riwayat Pekerjaan',
            'data' => $data,
            'columns' => $this->columns(),
        ]);
    }


    /**
     * Form edit data.
     */
    public function edit($id)
    {
        $data = RiwayatPekerjaan::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        return view('client.page.edit', [
            'title' => 'Edit Riwayat Pekerjaan',
            'data' => $data,
            'columns' => $this->columns(),
        ]);
    }


    /**
     * Memperbarui data.
     */
    public function update(
        Request $request,
        $id
    ) {
        $data = RiwayatPekerjaan::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        $validated = $request->validate([
            'Nama_Pekerjaan' =>
                'nullable|string|max:255',

            'Rincian_Pekerjaan' =>
                'nullable|string|max:255',

            'Waktu' =>
                'nullable|string|max:255',

            'LN_atau_DN' =>
                'nullable|string|max:255',
        ]);

        $data->update($validated);

        return redirect()
            ->to(
                pageUrl(
                    'RiwayatPekerjaanController'
                )
            )
            ->with(
                'success',
                'Riwayat pekerjaan berhasil diperbarui.'
            );
    }


    /**
     * Menghapus data.
     */
    public function destroy($id)
    {
        $data = RiwayatPekerjaan::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        $data->delete();

        return redirect()
            ->to(
                pageUrl(
                    'RiwayatPekerjaanController'
                )
            )
            ->with(
                'success',
                'Riwayat pekerjaan berhasil dihapus.'
            );
    }
}