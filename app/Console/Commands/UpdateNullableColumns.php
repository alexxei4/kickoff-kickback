<?php

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateNullableColumns extends Command
{
    protected $signature = 'update:nullable-default';
    protected $description = 'Update specified columns to allow nullable values in the database.';

    public function handle()
    {
        
        DB::statement('ALTER TABLE products MODIFY COLUMN is_featured BOOLEAN NULL');

       
        DB::statement('ALTER TABLE products MODIFY COLUMN is_available BOOLEAN NULL');

        $this->info('Columns updated successfully.');
    }
}
