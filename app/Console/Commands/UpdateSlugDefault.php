<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateSlugDefault extends Command
{
    protected $signature = 'update:slug-default';

    protected $description = 'Update the default value for the slug column in the products table';

    public function handle()
    {
        DB::statement("ALTER TABLE products ALTER COLUMN slug SET DEFAULT 'default-slug'");
        $this->info('Default value for the slug column updated successfully.');
    }
}
