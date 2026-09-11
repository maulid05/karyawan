<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relation\BelongsTo;

class Timeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'log',
    ];

    protected $casts = [
        'log' => 'array',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}