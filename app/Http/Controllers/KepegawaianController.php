<?php

namespace App\Http\Controllers;

use App\Models\Kepegawaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class KepegawaianController extends Controller
{
    public function update(Request $request, string $id)
    {
        $Kepegawaian = Kepegawaian::where('id', $id)
            ->firstOrFail();

        foreach ($request->all() as $key => $value) {

            if (Schema::hasColumn('kepegawaians', $key)) {
                $Kepegawaian->$key = $value ?: '-';
            }

        }

        $Kepegawaian->save();

        return redirect()->back();
    }
}