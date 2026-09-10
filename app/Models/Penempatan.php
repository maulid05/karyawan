<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penempatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'Status',
        'Ikatan_Kerja',
        'Jenjang_Pendidikan',
        'Perguruan_Tinggi',
        'Unit',
        'Taggal_Mulai',
        'Taggal_Surat_Terbit',
        'Penugasan',
    ];

    /**
     * Data penempatan dimiliki oleh satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}