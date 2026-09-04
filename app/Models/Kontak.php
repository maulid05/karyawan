<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kontak extends Model
{
    protected $table = 'kontaks';

    protected $fillable = [
        'user_id',
        'Email',
        'Alamat',
        'RT',
        'RW',
        'Desa_atau_Kelurahan',
        'Kecamatan',
        'Kabupaten_atau_Kota',
        'Provinsi',
        'Kode_Pos',
        'No_Telepon_Rumah',
        'No_Handphone',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}