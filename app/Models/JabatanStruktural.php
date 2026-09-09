<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JabatanStruktural extends Model
{
    protected $table = 'jabatan_strukturals';

    protected $fillable = [
        'user_id',
        'Nama_Jabatan',
        'Nomor_SK',
        'Tanggal_Mulai_Terbit',
        'Sumber_Gaji',
        'Status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}