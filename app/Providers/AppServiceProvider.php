<?php

namespace App\Providers;

use App\Context\ContextManager;
use Illuminate\Support\ServiceProvider;
use App\Observers\TimelineObserver;
use App\Models\{DataPribadi, ImpassingDanKepangkatan, Diklat, JabatanFungsional, JabatanStruktural, Keluarga, kepegawaian, Kependudukan, Kontak, PasFoto, Penempatan, ProfilAkademik};

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('context', function () {
            return new ContextManager();
        });
    }

    public function boot(): void
    {
    }
}