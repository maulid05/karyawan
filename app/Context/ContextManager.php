<?php

namespace App\Context;

use App\Models\JabatanStruktural;
use App\Models\Nav;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ContextManager
{
    public function set(int $id): JabatanStruktural
    {
        $context = JabatanStruktural::where('user_id', Auth::id())
            ->findOrFail($id);

        Session::put('active_context_id', $context->id);

        return $context;
    }

    public function id(): ?int
    {
        return Session::get('active_context_id');
    }

    public function active(): ?JabatanStruktural
    {
        $id = $this->id();

        if (!$id) {
            return null;
        }

        return JabatanStruktural::where('user_id', Auth::id())
            ->find($id);
    }

    public function navs()
    {
        $id = $this->id();

        if (!$id) {
            return collect();
        }

        return Nav::where('jabatan_struktural_id', $id)
            ->get();
    }

    public function clear(): void
    {
        Session::forget('active_context_id');
    }
}