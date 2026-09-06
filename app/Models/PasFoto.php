<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PasFoto extends Model
{
    protected $table = 'pas_fotos';

    protected $fillable = [
        'user_id',
        'Foto',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}