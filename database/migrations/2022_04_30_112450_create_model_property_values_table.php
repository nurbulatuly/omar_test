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
        Schema::create('model_property_values', function (Blueprint $table) {
            $table->foreignId('property_value_id');
            $table->morphs('model');
            $table->timestamps();

            $table->foreign('property_value_id')
                ->references('id')
                ->on('property_values')
                ->onDelete('cascade');

            $table->primary(['property_value_id', 'model_id', 'model_type'], 'pk_model_property_values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_property_values');
    }
};
