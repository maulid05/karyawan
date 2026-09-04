<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kependudukan extends Model
{
    protected $table = 'kependudukans';

    protected $fillable = [
        'user_id',
        'NIK',
        'Agama',
        'Kewarganegaraan',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}