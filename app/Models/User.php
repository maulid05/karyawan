<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles()
    {
        return $this->belongsToMany(
            Role::class,
            'user__roles',
            'user_id',
            'role_id'
        );
    }

    public function hasRoles(array $roles)
    {
        return $this->roles()
            ->whereIn('name', $roles)
            ->exists();
    }

    public function dataPribadi()
    {
        return $this->hasOne(DataPribadi::class);
    }

    public function kependudukan()
    {
        return $this->hasOne(Kependudukan::class);
    }

    public function keluarga()
    {
        return $this->hasOne(Keluarga::class);
    }

    public function kontak()
    {
        return $this->hasOne(Kontak::class);
    }
    public function kepegawaian()
    {
        return $this->hasOne(Kepegawaian::class);
    }
    
    public function profilAkademik()
    {
        return $this->hasOne(ProfilAkademik::class);
    }

    public function lainLain()
    {
        return $this->hasOne(LainLain::class);
    }
}