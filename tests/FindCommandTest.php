<?php

use Illuminate\Cache\CacheManager;
use LaraCache\Commands\FindCommand;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Foundation\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

class FindCommandTest extends PHPUnit_Framework_TestCase
{
    public function testFindCommand()
    {
        $command = new FindCommandTester(
            $cacheManager = Mockery::mock(CacheManager::class)
        );

        $application = new Application;
        $command->setLaravel($application);

        $storeMocker = Mockery::mock(Store::class);

        $cacheManager->shouldReceive('store')->once()->andReturn($storeMocker);
        $storeMocker->shouldReceive('get')->once()->with('name');

        $input = ['query' => 'name'];
        $command->run(new ArrayInput($input), new NullOutput);
    }
}

class FindCommandTester extends FindCommand
{
}