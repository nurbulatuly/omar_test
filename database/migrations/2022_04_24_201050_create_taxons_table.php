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
        Schema::create('taxons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('taxonomy_id')->unsigned();
            $table->foreignId('parent_id')->unsigned()->nullable();
            $table->integer('priority')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('ext_title', 511)->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('foreign_uid')->unique()->nullable();
            $table->string('foreign_parent_uid')->index()->nullable();
            $table->timestamps();

            $table->foreign('taxonomy_id')
                ->references('id')
                ->on('taxonomies')
                ->onDelete('cascade');

            $table->foreign('parent_id')
                ->references('id')
                ->on('taxons')
                ->onDelete('cascade');

            $table->unique(['taxonomy_id', 'slug', 'parent_id']);

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
        Schema::table('taxons', function (Blueprint $table){
            $table->dropForeign(['taxonomy_id']);
            $table->dropForeign(['parent_id']);
        });
        Schema::dropIfExists('taxons');
    }
};
