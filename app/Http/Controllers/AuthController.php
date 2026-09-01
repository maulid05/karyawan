<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function home()
    {
        $user = Auth::user();

        if ($user && $user->hasRoles(['superadmin'])) {
            return redirect()->route('index');
        }
    
        if ($user && $user->hasRoles(['client'])) {
            return redirect()->route('homepage');
        }

        if ($user && $user->hasRoles(['admin'])) {   
            return redirect()->route('dashboard');
        }

        abort(403);
    }
}
