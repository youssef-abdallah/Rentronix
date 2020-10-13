<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('address')->nullable();
            $table->double('credit')->default(0.0);
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        Schema::create('manufacturer_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->integer('rating')->nullable();
            $table->double('profit')->default(0.0);
            $table->float('percentage')->default(0.05);
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        Schema::create('manufacturer_locations', function (Blueprint $table) {
            $table->primary(['manufacturer_id','address']);
            $table->unsignedBigInteger('manufacturer_id');
            $table->string('address');
            $table->timestamps();

            $table->foreign('manufacturer_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('user_info');
        Schema::dropIfExists('manufacturer_locations');
        Schema::dropIfExists('manufacturer_info');
    }
}
