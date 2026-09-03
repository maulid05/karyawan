<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, DataPribadi};
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        
        dd($user);

        if ($user->hasRoles(['superadmin'])) {
            return redirect()->route('index');
        }
    
        if ($user->hasRoles(['client'])) {
            return redirect()->route('homepage');
        }

        if ($user->hasRoles(['admin'])) {   
            return redirect()->route('dashboard');
        }

        abort(403);
    }

    public function show(String $id) {
        //dd(Auth::user()->id);
        $user = DataPribadi::Where('user_id', Auth::user()->id)->first();

        //dd();

        if ($user == null) {
            DataPribadi::create([
                'user_id'       => Auth::id(),
                'NUPTK'         => '-',
                'NIDN'          => '-',
                'Nama'          => Auth::user()->name,
                'Jenis_Kelamin' => '-',
                'Tempat_Lahir'  => '-',
                'Tanggal_Lahir' => '-',
                'NIP'           => '-',
            ]);
        }

        return redirect()->route('profile', Auth::user()->id);
    }
}
