<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use TypeError;

class SaveBread extends Command
{
    /**
     * @var string
     */
    protected $signature = 'voyager:save-bread';

    /**
     * @var string
     */
    protected $description
        = 'Saves created BREAD related tables in voyager, so they can be moved to the other database';

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
            'mysqldump -h %s -P %d -u root -p %s data_rows data_types menus menu_items roles permission_role settings permissions >./resources/db/voyager-dump.sql',
            escapeshellarg($host),
            $port,
            escapeshellarg($databaseName)
        );

        shell_exec($command);
    }
}
