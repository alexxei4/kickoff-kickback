<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_featured')->nullable()->default(null)->change();
            $table->boolean('is_available')->nullable()->default(null)->change();
        });
    }

    public function down()
    {
        
    }
}
