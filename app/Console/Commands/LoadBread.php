<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use TypeError;

class LoadBread extends Command
{
    /**
     * @var string
     */
    protected $signature = 'voyager:load-bread';

    /**
     * @var string
     */
    protected $description = 'Loads exported BREAD to database';

    public function handle(): void
    {
        $connection = DB::connection();

        $host = $connection->getConfig('host');
        $port = $connection->getConfig('port');
        $databaseName = $connection->getDatabaseName();

        if (!is_string($host) || !is_numeric($port)) {
            throw new TypeError('Some of the configuration variables have wrong type.');
        }

        $command = sprintf(
            'mysql -h %s -P %d -u root -p %s < ./resources/db/voyager-dump.sql',
            escapeshellarg($host),
            $port,
            escapeshellarg($databaseName)
        );

        echo shell_exec($command);
    }
}
