<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfilAkademik extends Model
{
    use HasFactory;

    protected $table = 'profil_akademiks';

    protected $fillable = [
        'user_id',

        'rumpun_ilmu',
        'pohon_ilmu',
        'kelompok_ilmu',
        'cabang_ilmu',

        'scopus_id',
        'scopus_link',
        'scopus_h_index',

        'google_scholar_id',
        'google_scholar_link',
        'google_scholar_h_index',

        'orcid_id',
        'orcid_link',

        'repository_universitas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}