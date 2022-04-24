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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('delivery_type')->nullable();
            $table->float('amount', 18,2);
            $table->string('payment_type');
            $table->integer('total_products_count');
            $table->foreignId('cart_id');
            $table->foreignId('template_id');
            $table->string('order_state');
            $table->foreignId('user_id');
            $table->foreignId('shipping_address_id');
            $table->text('notes');
            $table->float('used_bonuses', 18,2);

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
        Schema::dropIfExists('orders');
    }
};
