<?php

namespace PartiMate\CDNMate;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        $this->app->singleton('cdnmate', function () {
            return new CDNMate(new Services\CDNService(), new Services\ImageOptimizer());
        });

        $this->mergeConfigFrom(__DIR__ . '/../config/cdnmate.php', 'cdnmate');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/cdnmate.php' => config_path('cdnmate.php'),
        ], 'cdnmate');
    }
}