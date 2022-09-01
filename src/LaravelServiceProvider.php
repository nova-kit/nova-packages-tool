<?php

namespace NovaKit\NovaPackagesTool;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::remoteScript(mix('tool.js', 'vendor/nova-kit/nova-packages-tool'));
        });

        $this->publishes([
            __DIR__.'/../dist' => public_path('vendor/nova-kit/nova-packages-tool'),
        ], ['nova-assets', 'laravel-assets']);
    }
}
