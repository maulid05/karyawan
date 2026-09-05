<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LainLain extends Model
{
    protected $table = 'lain_lains';

    protected $fillable = [
        'user_id',
        'NPWP',
        'Nama_Wajib_Pajak',
        'Sinta_Id',
        'Sinta_Link',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}