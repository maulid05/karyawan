<?php

namespace App\Http\Controllers;

use App\Models\LainLain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class LainLainController extends Controller
{
    public function update(Request $request, string $id)
    {
        $lainLain = LainLain::where('id', $id)
            ->firstOrFail();

        foreach ($request->all() as $key => $value) {

            if (Schema::hasColumn('lain_lains', $key)) {
                $lainLain->$key = $value ?: '-';
            }

        }

        $lainLain->save();

        return redirect()->back();
    }
}