<?php

namespace App\Http\Controllers;

use App\Models\MasterUnit;
use Illuminate\Http\Request;

class MasterUnitController extends Controller
{
    public function index()
    {
        $data = MasterUnit::latest()->get();

        return view('admin.masterUnit.index', [
            'title' => 'Master Unit',
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('admin.masterUnit.create', [
            'title' => 'Tambah Unit',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nama_Unit' => 'required|string|max:255',
            'Status' => 'required|string|max:255',
        ]);

        MasterUnit::create($validated);

        return redirect()
            ->to(pageUrl('MasterUnitController'))
            ->with(
                'success',
                'Master unit berhasil ditambahkan.'
            );
    }

    public function show($id)
    {
        $data = MasterUnit::findOrFail($id);

        return view('admin.masterUnit.show', [
            'title' => 'Detail Master Unit',
            'data' => $data,
        ]);
    }

    public function edit($id)
    {
        $data = MasterUnit::findOrFail($id);

        return view('admin.masterUnit.edit', [
            'title' => 'Edit Master Unit',
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = MasterUnit::findOrFail($id);

        $validated = $request->validate([
            'Nama_Unit' => 'required|string|max:255',
            'Status' => 'required|string|max:255',
        ]);

        $data->update($validated);

        return redirect()
            ->to(pageUrl('MasterUnitController'))
            ->with(
                'success',
                'Master unit berhasil diperbarui.'
            );
    }

    public function destroy($id)
    {
        $data = MasterUnit::findOrFail($id);

        $data->delete();

        return redirect()
            ->to(pageUrl('MasterUnitController'))
            ->with(
                'success',
                'Master unit berhasil dihapus.'
            );
    }
}