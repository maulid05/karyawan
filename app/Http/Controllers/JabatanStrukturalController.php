<?php

namespace App\Http\Controllers;

use App\Models\JabatanStruktural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class JabatanStrukturalController extends Controller
{
    /**
     * Mengambil semua kolom tabel secara otomatis.
     */
    private function columns()
    {
        return Schema::getColumnListing(
            (new JabatanStruktural)->getTable()
        );
    }


    /**
     * Menampilkan daftar jabatan struktural
     * milik user yang sedang login.
     */
    public function index()
    {
        $data = JabatanStruktural::where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->get();

        return view('client.page.index', [
            'title' => 'Jabatan Struktural',
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
            'title' => 'Tambah Jabatan Struktural',
            'columns' => $this->columns(),
        ]);
    }


    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama_Jabatan' => 'nullable|string|max:255',
            'Nomor_SK' => 'nullable|string|max:255',
            'Tanggal_Mulai_Terbit' => 'nullable|string|max:255',
            'Sumber_Gaji' => 'nullable|string|max:255',
            'Status' => 'nullable|string|max:255',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Data otomatis milik user yang sedang login
        |--------------------------------------------------------------------------
        */

        $validated['user_id'] = Auth::id();


        JabatanStruktural::create($validated);


        return redirect()
            ->to(pageUrl('JabatanStrukturalController'))
            ->with(
                'success',
                'Data jabatan struktural berhasil ditambahkan.'
            );
    }


    /**
     * Menampilkan detail data.
     *
     * ID berasal dari PageController setelah decrypt.
     */
    public function show($id)
    {
        $jabatanStruktural = JabatanStruktural::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);


        return view('client.page.show', [
            'title' => 'Detail Jabatan Struktural',
            'data' => $jabatanStruktural,
            'columns' => $this->columns(),
        ]);
    }


    /**
     * Form edit data.
     *
     * ID berasal dari PageController setelah decrypt.
     */
    public function edit($id)
    {
        $jabatanStruktural = JabatanStruktural::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);


        return view('client.page.edit', [
            'title' => 'Edit Jabatan Struktural',
            'data' => $jabatanStruktural,
            'columns' => $this->columns(),
        ]);
    }


    /**
     * Memperbarui data.
     *
     * ID berasal dari PageController setelah decrypt.
     */
    public function update(
        Request $request,
        $id
    ) {
        $jabatanStruktural = JabatanStruktural::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);


        $validated = $request->validate([
            'Nama_Jabatan' => 'nullable|string|max:255',
            'Nomor_SK' => 'nullable|string|max:255',
            'Tanggal_Mulai_Terbit' => 'nullable|string|max:255',
            'Sumber_Gaji' => 'nullable|string|max:255',
            'Status' => 'nullable|string|max:255',
        ]);


        $jabatanStruktural->update($validated);


        return redirect()
            ->to(pageUrl('JabatanStrukturalController'))
            ->with(
                'success',
                'Data jabatan struktural berhasil diperbarui.'
            );
    }


    /**
     * Menghapus data.
     *
     * ID berasal dari PageController setelah decrypt.
     */
    public function destroy($id)
    {
        $jabatanStruktural = JabatanStruktural::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);


        $jabatanStruktural->delete();


        return redirect()
            ->to(pageUrl('JabatanStrukturalController'))
            ->with(
                'success',
                'Data jabatan struktural berhasil dihapus.'
            );
    }
}