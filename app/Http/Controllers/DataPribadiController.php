<?php

namespace App\Http\Controllers;

use App\Models\{DataPribadi, Kependudukan, Keluarga, Kontak};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DataPribadiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id )
    {
        //dd($id);

        $datapribadi = DataPribadi::Where('user_id', $id)->with('user')->first();
        $kependudukan = Kependudukan::where('user_id', $id)->first();
        $keluarga = Keluarga::where('user_id', $id)->first();
        $kontak = Kontak::where('user_id', $id)->first();
        $kepegawaian = Kontak::where('user_id', $id)->first();
        //dd($datapribadi ,$datapribadi->user, $datapribadi->user->roles);

        return view('auth.profile', compact('datapribadi', 'kependudukan', 'keluarga', 'kontak', 'kepegawaian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        //dd($request->all());

        $data = DataPribadi::where('id', $id)->first();

        //dd($data);
        foreach ($request->all() as $k => $v) {
            if (Schema::hasColumn('data_pribadis', $k)) {
                $data->$k = $v ?? '-';
            }
        }

        $data->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $dataPribadi)
    {
        //
    }
}
