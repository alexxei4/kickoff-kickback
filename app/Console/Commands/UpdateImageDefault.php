<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateImageDefault extends Command
{
    protected $signature = 'update:image-default';

    protected $description = 'Update the image column to be nullable in the products table';

    public function handle()
    {
        DB::statement("ALTER TABLE products MODIFY COLUMN image VARCHAR(255) DEFAULT NULL");
        $this->info('Image column made nullable successfully.');
    }
}
