<?php

namespace LaraCache\Commands;

use Illuminate\Console\Command;
use Illuminate\Cache\CacheManager;
use Symfony\Component\Console\Input\InputArgument;

class FindCommand extends Command
{
    /**
     * @var string
     */
    protected $name = 'cache:find';

    /**
     * @var string
     */
    protected $description = 'Query your current cached data.';

    /**
     * @var \Illuminate\Cache\CacheManager
     */
    private $manager;

    /**
     * @var array
     */
    private $headers = ['Query', 'Key', 'Value', 'Store'];

    /**
     * FindCommand constructor.
     *
     * @param  \Illuminate\Cache\CacheManager  $cache
     * @return void
     */
    public function __construct(CacheManager $manager)
    {
        parent::__construct();

        $this->manager = $manager;
    }

    /**
     * Fire the command.
     *
     * @return void
     */
    public function fire()
    {
        $query = $this->argument('query');

        // Lookup the query passed to the command
        // in the default cache driver.
        $results = $this->getFromDefaultCache();

        if (is_null($results)) {
            return $this->info('No results for that query.');
        }

        $this->buildTable($results);
    }

    /**
     * The command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            ['query', InputArgument::REQUIRED, 'The key you are looking for.'],
        ];
    }

    private function getFromDefaultCache()
    {
        switch ($this->manager->getDefaultDriver()) {
            case 'redis':
                return $this->fromRedis();
            default:
                return $this->fromDefault();
        }
    }

    private function fromRedis()
    {
        $store = $this->manager->store();

        $results = $store->connection()->executeRaw([
            'GET', $this->argument('query')
        ]);

        return $results;
    }

    private function fromDefault()
    {
        $results = $this->manager->store()->get(
            $this->argument('query')
        );

        return $results;
    }

    /**
     * Build the table.
     *
     * @param  array  $results
     * @return void
     */
    private function buildTable(array $results)
    {
        $array = [];

        foreach ($results as $key => $value) {
            array_push($array, [
                $this->argument('query'),
                $key,
                $value,
                $this->manager->getDefaultDriver(),
            ]);
        }

        $this->table($this->headers, $array);
    }
}
