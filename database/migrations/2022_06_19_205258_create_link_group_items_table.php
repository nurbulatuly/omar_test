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
        Schema::create('link_group_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('link_group_id')->unsigned();
            $table->foreignId('linkable_id')->unsigned();
            $table->string('linkable_type');
            $table->timestamps();

            $table->foreign('link_group_id')
                ->references('id')
                ->on('link_groups')
                ->onDelete('cascade');

            $table->unique(['link_group_id', 'linkable_id', 'linkable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_group_items');
    }
};
