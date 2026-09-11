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
        DataPribadi::observe(TimelineObserver::class);
        ProfilAkademik::observe(TimelineObserver::class);
        JabatanStruktural::observe(TimelineObserver::class);
        ImpassingDanKepangkatan::observe(TimelineObserver::class);
        Diklat::observe(TimelineObserver::class);
        JabatanFungsional::observe(TimelineObserver::class);
        Keluarga::observe(TimelineObserver::class);
        kepegawaian::observe(TimelineObserver::class);
        Kependudukan::observe(TimelineObserver::class);
        Kontak::observe(TimelineObserver::class);
        PasFoto::observe(TimelineObserver::class);
        Penempatan::observe(TimelineObserver::class);
    }
}