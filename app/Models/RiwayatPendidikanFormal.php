<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatPendidikanFormal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'Gelar',
        'Bidang_Studi',
        'Sekolah_atau_Universitas',
        'Tahun_LuLus',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}