<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keluarga extends Model
{
    protected $table = 'keluargas';

    protected $fillable = [
        'user_id',
        'Status_Perkawinan',
        'Nama_Suami_Atau_Istri',
        'NIP_Suami_Atau_Istri',
        'Pekerjaan_Suami_Atau_Istri',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}