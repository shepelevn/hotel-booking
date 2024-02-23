<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        $databaseName = DB::connection()->getDatabaseName();

        echo shell_exec(
            'sudo mysql -u root -p ' . $databaseName . ' <./resources/db/voyager-dump.sql',
        );
    }
}
