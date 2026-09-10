<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nav extends Model
{
    use HasFactory;

    protected $table = 'navs';

    protected $fillable = [
        'jabatan_struktural_id',
        'Nama',
        'Controller',
        'Method',
    ];

    public function jabatanStruktural()
    {
        return $this->belongsTo(
            JabatanStruktural::class,
            'jabatan_struktural_id'
        );
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
}