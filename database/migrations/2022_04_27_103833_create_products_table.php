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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('taxon_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('sku')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->enum('state', ['draft', 'inactive', 'active', 'unavailable', 'retired'])->nullable();
            $table->string('ext_title', 511)->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->string('foreign_uid')->unique()->nullable();
            $table->string('foreign_category_uid')->unique()->nullable();

            $table->foreign('taxon_id')
                ->references('id')
                ->on('taxons')
                ->onDelete('cascade');
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
};
