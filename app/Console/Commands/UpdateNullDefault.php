<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateSlugDefault extends Command
{
    protected $signature = 'update:null-default';

    protected $description = 'Update the default value for the is_available and is_featured columns in the products table';

    public function handle()
    {
        DB::statement("ALTER TABLE products ALTER COLUMN is_available  BOOLEAN NULL");
        DB::statement("ALTER TABLE products ALTER COLUMN is_featured  BOOLEAN NULL");
        $this->info('Default value for the is_available and is_featured updated successfully.');
    }
}
