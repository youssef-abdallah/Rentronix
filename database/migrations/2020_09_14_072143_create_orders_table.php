<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('seller_id');
            $table->enum('shipping_status', array('pending','shipped','delivered'));
            $table->float('total_cost');
            $table->unsignedBigInteger('payment_id');
            $table->timestamps();
            $table->date('delivery_date');

            
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');  
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
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
}
