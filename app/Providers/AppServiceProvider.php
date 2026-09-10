<?php

namespace App\Providers;

use App\Context\ContextManager;
use Illuminate\Support\ServiceProvider;

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
        //
    }
}