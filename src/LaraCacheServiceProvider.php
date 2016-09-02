<?php

namespace LaraCache;

use LaraCache\Commands\FindCommand;
use LaraCache\Commands\ShowCommand;
use Illuminate\Support\ServiceProvider;

class LaraCacheServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->getCommands());
    }

    /**
     * The application commands.
     *
     * @return array
     */
    private function getCommands()
    {
        return [
            ShowCommand::class,
            FindCommand::class,
        ];
    }
}
