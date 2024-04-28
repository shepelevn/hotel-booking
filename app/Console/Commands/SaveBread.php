<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        $databaseName = DB::connection()->getDatabaseName();

        exec(
            'sudo mysqldump -u root -p '
            . $databaseName
            . ' data_rows data_types menus menu_items roles permission_role settings permissions >./resources/db/voyager-dump.sql'
        );
    }
}
