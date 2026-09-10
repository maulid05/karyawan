<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'Nama_Jabatan',
        'Jenis_Jabatan',
        'Status',
    ];
}