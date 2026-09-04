<?php

namespace App\Http\Controllers;

use App\Models\Kependudukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class KependudukanController extends Controller
{
    public function update(Request $request, string $id)
    {
        $kependudukan = Kependudukan::where('id', $id)
            ->firstOrFail();

        $request->validate([
            'NIK' => [
                'nullable',
                'regex:/^(?:-|[0-9]{16})$/'
            ],
        ], [
            'NIK.regex' => 'NIK harus terdiri dari 16 digit angka atau "-".',
        ]);

        foreach ($request->all() as $key => $value) {

            if (Schema::hasColumn('kependudukans', $key)) {
                $kependudukan->$key = $value ?: '-';
            }

        }

        $kependudukan->save();

        return redirect()->back();
    }
}