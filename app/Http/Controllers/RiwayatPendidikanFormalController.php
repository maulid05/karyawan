<?php

namespace App\Http\Controllers;

use App\Models\RiwayatPendidikanFormal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class RiwayatPendidikanFormalController extends Controller
{
    /**
     * Mengambil daftar kolom tabel.
     */
    private function columns()
    {
        return Schema::getColumnListing(
            (new RiwayatPendidikanFormal)->getTable()
        );
    }


    /**
     * Menampilkan seluruh riwayat pendidikan
     * milik user yang sedang login.
     */
    public function index()
    {
        $data = RiwayatPendidikanFormal::where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->get();

        return view('client.page.index', [
            'title' => 'Riwayat Pendidikan Formal',
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
            'title' => 'Riwayat Pendidikan Formal',
            'columns' => $this->columns(),
        ]);
    }


    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Gelar' => 'nullable|string|max:255',

            'Bidang_Studi' => 'nullable|string|max:255',

            'Sekolah_atau_Universitas' =>
                'nullable|string|max:255',

            'Tahun_LuLus' =>
                'nullable|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();

        RiwayatPendidikanFormal::create(
            $validated
        );

        return redirect()
            ->to(
                pageUrl(
                    'RiwayatPendidikanFormalController'
                )
            )
            ->with(
                'success',
                'Riwayat pendidikan formal berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail data.
     */
    public function show($id)
    {
        $data = RiwayatPendidikanFormal::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        return view('client.page.show', [
            'title' => 'Detail Riwayat Pendidikan Formal',
            'data' => $data,
            'columns' => $this->columns(),
        ]);
    }


    /**
     * Form edit data.
     */
    public function edit($id)
    {
        $data = RiwayatPendidikanFormal::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        return view('client.page.edit', [
            'title' => 'Edit Riwayat Pendidikan Formal',
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
        $data = RiwayatPendidikanFormal::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        $validated = $request->validate([
            'Gelar' => 'nullable|string|max:255',

            'Bidang_Studi' => 'nullable|string|max:255',

            'Sekolah_atau_Universitas' =>
                'nullable|string|max:255',

            'Tahun_LuLus' =>
                'nullable|string|max:255',
        ]);

        $data->update($validated);

        return redirect()
            ->to(
                pageUrl(
                    'RiwayatPendidikanFormalController'
                )
            )
            ->with(
                'success',
                'Riwayat pendidikan formal berhasil diperbarui.'
            );
    }


    /**
     * Menghapus data.
     */
    public function destroy($id)
    {
        $data = RiwayatPendidikanFormal::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        $data->delete();

        return redirect()
            ->to(
                pageUrl(
                    'RiwayatPendidikanFormalController'
                )
            )
            ->with(
                'success',
                'Riwayat pendidikan formal berhasil dihapus.'
            );
    }
}