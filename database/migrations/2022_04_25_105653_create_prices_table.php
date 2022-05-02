<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();


            $table->unsignedBigInteger('product_id')->default(0);

            $table->float('price');
            $table->string('currency')->default('kzt');
            $table->string('dimenshion_value')->nullable();
            $table->tinyInteger('is_dale')->nullable();
            $table->integer('sale_value')->nullable();
            $table->string('product_url_id'); // Product UID from 1C

            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
}
