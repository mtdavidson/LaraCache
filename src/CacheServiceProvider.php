<?php

namespace LaraCache;

use LaraCache\Commands\ShowCommand;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
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
