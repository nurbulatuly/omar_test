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
        Schema::create('link_groups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('link_type_id')->unsigned();
            $table->bigInteger('property_id')->nullable();
            $table->timestamps();

            $table->foreign('link_type_id')
                ->references('id')
                ->on('link_types');

            if (Schema::hasTable('properties')) {
                $table->foreign('property_id')
                    ->references('id')
                    ->on('properties');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_groups');
    }
};
