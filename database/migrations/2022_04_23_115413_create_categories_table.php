<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('parent_id')->default(0);

            $table->string('slug')->nullable(); //unique();
            $table->string('title');

            $table->string('img_url')->nullable();
            $table->string('icon_url')->nullable();

            $table->boolean('show_on_main_page')->default(false);
            $table->integer('order_on_main_page')->default(0);

            $table->string('url_id'); // UID from 1C
            $table->string('parent_url_id'); // Parent UID from 1C

            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
