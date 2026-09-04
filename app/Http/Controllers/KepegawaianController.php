<?php

namespace App\Http\Controllers;

use App\Models\Kepegawaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class KepegawaianController extends Controller
{
    public function update(Request $request, string $id)
    {
        $kepegawaian = Kepegawaian::where('id', $id)->firstOrFail();

        foreach ($request->all() as $key => $value) {
            if (Schema::hasColumn('kepegawaians', $key)) {
                $kepegawaian->$key = $value ?: '-';
            }
        }

        $kepegawaian->save();

        return redirect()->back();
    }
}