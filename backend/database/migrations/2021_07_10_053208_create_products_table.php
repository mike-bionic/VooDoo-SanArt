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

            $table->string('title', 250);
            $table->string('images')->nullable();
            $table->text('description')->nullable();
            $table->string('status', 250)->default(\App\Models\Product::STATUS_ACTIVE);
            $table->unsignedBigInteger('quantity')->default(0);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->float('price');
            $table->boolean('featured')->default(false);
            $table->boolean('enabled')->default(true);
            $table->bigInteger('viewed')->default(0);

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