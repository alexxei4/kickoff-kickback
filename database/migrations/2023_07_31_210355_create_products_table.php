<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("category_id");
            $table->string("name");
            $table->string('slug', 255);
            $table->longText("description");
            $table->decimal("cost");
            $table->integer("quantity");
            $table->string("image");
            $table->boolean('is_featured')->nullable()->default(null)->change();
            $table->boolean('is_available')->nullable()->default(null)->change();
            $table->string("brand");
            $table->string('sku')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
