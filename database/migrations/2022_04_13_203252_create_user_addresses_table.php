<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('province_id');
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->string('apartment')->nullable();
            $table->float('lat', 10,7);
            $table->float('lon', 10,7);
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('user_id');

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
        Schema::table('user_addresses', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('user_addresses');
    }
}
