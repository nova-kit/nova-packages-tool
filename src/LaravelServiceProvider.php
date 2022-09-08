<?php

namespace NovaKit\NovaPackagesTool;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Laravel\Nova\Script;

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
            array_unshift(
                Nova::$scripts, Script::remote(mix('tool.js', 'vendor/nova-kit/nova-packages-tool'))
            );
        });

        $this->publishes([
            __DIR__.'/../dist' => public_path('vendor/nova-kit/nova-packages-tool'),
        ], ['nova-assets', 'laravel-assets']);
    }
}
