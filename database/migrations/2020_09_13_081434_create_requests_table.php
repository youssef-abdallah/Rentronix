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
            $table->string('product_name');
            $table->integer('quantity')->default(1);
            $table->text('description')->nullable();
            $table->boolean('approved')->default(false);
            $table->enum('type', array('sell', 'loan'));
            $table->float('price')->default(0);
            $table->float('price_per_hour')->default(0);
            $table->string('image')->default('/');
            $table->string('datasheet')->default('/');
            $table->string('subcategory_title');
            $table->string('subcategory_description')->default('default description');
            $table->string('category_title')->default('default title');
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
