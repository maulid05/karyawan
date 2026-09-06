<?php

namespace App\Http\Controllers;

use App\Models\PasFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PasFotoController extends Controller
{
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $pasFoto = PasFoto::where('id', $id)
            ->first();

        $request->validate([
            'Foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'Foto.image' => 'File harus berupa gambar.',
            'Foto.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'Foto.max' => 'Ukuran foto maksimal 2 MB.',
        ]);

        if ($request->hasFile('Foto')) {

            if (
                $pasFoto->Foto &&
                Storage::disk('public')->exists($pasFoto->Foto)
            ) {
                Storage::disk('public')->delete($pasFoto->Foto);
            }

            $pasFoto->Foto = $request->file('Foto')
                ->store('pas-foto', 'public');
        }

        $pasFoto->save();

        return redirect()->back();
    }
}