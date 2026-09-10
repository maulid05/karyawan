<?php

namespace App\Http\Controllers;

use App\Facades\Context;

class ContextController extends Controller
{
    /**
     * Mengaktifkan jabatan sebagai context.
     */
    public function activate($id)
    {
        Context::set((int) $id);

        return redirect()->back();
    }

    /**
     * Menghapus context aktif.
     */
    public function clear()
    {
        Context::clear();

        return redirect()->back();
    }
}