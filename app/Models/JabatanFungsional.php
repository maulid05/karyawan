<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JabatanFungsional extends Model
{
    use HasFactory;

    protected $table = 'jabatan_fungsionals';

    protected $fillable = [
        'user_id',
        'Jabantan_Fungsional',
        'No_SK',
        'Tanggal_Masuk',
        'Status_Pegawai',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}