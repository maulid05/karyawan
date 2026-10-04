<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MasterUserController extends Controller
{
    public function index()
    {
        $data = User::latest()->where('name', '!=', 'SuperAdmin')->where('name', '!=', 'admin')->get();

        return view('admin.masterUser.index', [
            'title' => 'Master User',
            'data' => $data,
        ]);
    }

    public function create()
    {
        return view('admin.masterUser.create', [
            'title' => 'Tambah User',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'Status' => 'required|string|max:255',
        ]);

        User::create($validated);

        return redirect()
            ->to(pageUrl('MasterUserController'))
            ->with(
                'success',
                'Master user berhasil ditambahkan.'
            );
    }

    public function show($id)
    {
        $data = User::findOrFail($id);

        return view('admin.masterUser.show', [
            'title' => 'Detail Master User',
            'data' => $data,
        ]);
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);

        return view('admin.masterUser.edit', [
            'title' => 'Edit Master User',
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'Status' => 'required|string|max:255',
        ]);

        $data->update($validated);

        return redirect()
            ->to(pageUrl('MasterUserController'))
            ->with(
                'success',
                'Master user berhasil diperbarui.'
            );
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);

        $data->delete();

        return redirect()
            ->to(pageUrl('MasterUserController'))
            ->with(
                'success',
                'Master user berhasil dihapus.'
            );
    }
}