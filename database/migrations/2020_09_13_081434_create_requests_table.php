<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id')->default(1);
            $table->integer('quantity')->default(1);
            $table->text('description')->nullable();
            $table->boolean('approved')->default(false);
            $table->enum('type', array('sell', 'loan'));
            $table->float('price')->default(0);
            $table->float('price_per_hour')->default(0);
            $table->string('image')->default('/');
            $table->string('datasheet')->default('/');
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
        Schema::dropIfExists('requests');
    }
}
