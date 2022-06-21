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
        Schema::create('model_taxons', function (Blueprint $table) {
            $table->unsignedBigInteger('taxon_id');
            $table->morphs('model');
            $table->timestamps();

            $table->foreign('taxon_id')
                ->references('id')
                ->on('taxons')
                ->onDelete('cascade');

            $table->primary(['taxon_id', 'model_id', 'model_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_taxons');
    }
};
