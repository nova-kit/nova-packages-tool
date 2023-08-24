<?php

namespace NovaKit\NovaPackagesTool\Listeners;

use Illuminate\Filesystem\Filesystem;
use Orchestra\Workbench\Events\InstallEnded;
use Orchestra\Workbench\Workbench;

class InstalledWorkbench
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem;
     */
    public $files;

    /**
     * Construct a new event listener.
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
    }

    /**
     * Handle the event.
     */
    public function handle(InstallEnded $event)
    {
        $workingDirectory = realpath(__DIR__.'/../../stubs');

        $this->files->ensureDirectoryExists(Workbench::path('app/Nova'), 0755, true);
        $this->files->ensureDirectoryExists(Workbench::path('app/Providers'), 0755, true);

        if (! $this->files->exists(Workbench::path('app/Nova/User.php'))) {
            $this->files->copy(
                $workingDirectory.DIRECTORY_SEPARATOR.'UserResource.stub',
                Workbench::path('app/Nova/User.php')
            );
        }

        if (! $this->files->exists(Workbench::path('app/Providers/NovaServiceProvider.php'))) {
            $this->files->copy(
                $workingDirectory.DIRECTORY_SEPARATOR.'NovaServiceProvider.stub',
                Workbench::path('app/Providers/NovaServiceProvider.php')
            );
        }

        if (! $this->files->exists(Workbench::path('database/seeders/DatabaseSeeder.php'))) {
            $this->files->copy(
                $workingDirectory.DIRECTORY_SEPARATOR.'DatabaseSeeder.stub',
                Workbench::path('database/seeders/DatabaseSeeder.php')
            );
        }
    }
}
