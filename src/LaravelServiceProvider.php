<?php

namespace NovaKit\NovaPackagesTool;

use Composer\InstalledVersions;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Laravel\Nova\Script;
use Orchestra\Workbench\Events\InstallEnded;
use Orchestra\Workbench\Events\InstallStarted;

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

        if (
            $this->app->runningInConsole()
            && \defined('TESTBENCH_WORKING_PATH')
            && InstalledVersions::isInstalled('orchestra/workbench')
        ) {
            tap($this->app->make('events'), function (EventDispatcher $event) {
                $event->listen(InstallStarted::class, [Listeners\InstallingWorkbench::class, 'handle']);
                $event->listen(InstallEnded::class, [Listeners\InstalledWorkbench::class, 'handle']);
            });
        }
    }
}
