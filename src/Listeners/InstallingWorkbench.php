<?php

namespace NovaKit\NovaPackagesTool\Listeners;

use Illuminate\Filesystem\Filesystem;
use Orchestra\Workbench\Events\InstallStarted;
use Orchestra\Workbench\Workbench;

class InstallingWorkbench
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
    public function handle(InstallStarted $event)
    {
        $workingDirectory = realpath(__DIR__.'/../../stubs');

        if (! $this->files->exists(Workbench::packagePath('testbench.yaml'))) {
            $this->files->copy(
                $workingDirectory.DIRECTORY_SEPARATOR.'testbench.stub',
                Workbench::packagePath('testbench.yaml')
            );
        }
    }
}
