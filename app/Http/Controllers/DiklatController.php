<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Http\Requests\StoreDiklatRequest;
use App\Http\Requests\UpdateDiklatRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class DiklatController extends Controller
{
    /**
     * Mengambil daftar kolom tabel.
     */
    private function columns()
    {
        return Schema::getColumnListing(
            (new Diklat)->getTable()
        );
    }

    /**
     * Menampilkan data diklat
     * milik user yang sedang login.
     */
    public function index()
    {
        $data = Diklat::where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->get();

        return view('client.page.index', [
            'title' => 'Diklat',
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
            'title' => 'Tambah Diklat',
            'columns' => $this->columns(),
        ]);
    }

    /**
     * Menyimpan data diklat.
     */
    public function store(StoreDiklatRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = Auth::id();

        Diklat::create($validated);

        return redirect()
            ->to(pageUrl('DiklatController'))
            ->with(
                'success',
                'Data diklat berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan detail data.
     */
    public function show($id)
    {
        $data = Diklat::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        return view('client.page.show', [
            'title' => 'Detail Diklat',
            'data' => $data,
            'columns' => $this->columns(),
        ]);
    }

    /**
     * Menampilkan form edit.
     */
    public function edit($id)
    {
        $data = Diklat::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        return view('client.page.edit', [
            'title' => 'Edit Diklat',
            'data' => $data,
            'columns' => $this->columns(),
        ]);
    }

    /**
     * Mengupdate data diklat.
     */
    public function update(
        UpdateDiklatRequest $request,
        $id
    ) {
        $data = Diklat::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        $data->update(
            $request->validated()
        );

        return redirect()
            ->to(pageUrl('DiklatController'))
            ->with(
                'success',
                'Data diklat berhasil diperbarui.'
            );
    }

    /**
     * Menghapus data diklat.
     */
    public function destroy($id)
    {
        $data = Diklat::where(
            'user_id',
            Auth::id()
        )
        ->findOrFail($id);

        $data->delete();

        return redirect()
            ->to(pageUrl('DiklatController'))
            ->with(
                'success',
                'Data diklat berhasil dihapus.'
            );
    }
}