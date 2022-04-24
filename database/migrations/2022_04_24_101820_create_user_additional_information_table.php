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
        Schema::create('user_additional_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('marital_status', ['M', 'S', 'D', 'W'])->nullable();
            $table->boolean('has_children')->nullable();
            $table->integer('family_persons_count');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_additional_information', function (Blueprint $table) {
           $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('user_additional_information');
    }
};
