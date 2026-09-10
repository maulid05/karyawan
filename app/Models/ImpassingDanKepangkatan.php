<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImpassingDanKepangkatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'Pangkat_atau_Golongan',
        'No_SK',
        'Tanggal_SK',
        'Tanggal_Mulai',
    ];

    /**
     * Data ini dimiliki oleh satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}