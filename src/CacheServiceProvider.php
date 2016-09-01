<?php

namespace LaraCache;

use LaraCache\Commands\ShowCommand;
use Illuminate\Support\ServiceProvider;

class LaraCacheServiceProvider extends ServiceProvider
{
    /**
     * Register the commands.
     *
     * @return array
     */
    public function commands()
    {
        return [
            ShowCommand::class,
        ];
    }
}