<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kepegawaian extends Model
{
    protected $table = 'kepegawaians';

    protected $fillable = [
        'user_id',
        'Nomor_SK',
        'Tanggal_Masuk',
        'Sumber_Gaji',
        'Nama_Jabatan',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}