<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id');
            $table->string('value');
            $table->string('title');
            $table->integer('priority')->nullable();
            $table->json('settings')->nullable();
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');

            $table->index('priority');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_values', function (Blueprint $table){
           $table->dropForeign(['property_id']);
        });
        Schema::dropIfExists('property_values');
    }
};
