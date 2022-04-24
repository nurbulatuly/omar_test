<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('country_code');
            $table->string('phone_number');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('organization_title');
            $table->string('registration_number');
            $table->boolean('include_vat');
            $table->boolean('has_license');
            $table->string('password');
            $table->string('current_state');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
