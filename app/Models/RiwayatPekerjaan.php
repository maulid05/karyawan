<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPekerjaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'Nama_Pekerjaan',
        'Rincian_Pekerjaan',
        'Waktu',
        'LN_atau_DN',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}