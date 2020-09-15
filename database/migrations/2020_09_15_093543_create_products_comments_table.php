<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_comments', function (Blueprint $table) {
            $table->engine = ' MyISAM' ; // to remove error SQLSTATE[HY000]: General error: 1215
            $table->bigIncrements('id');
            $table->unsignedInteger('rating');
            $table->string(' content');
            $table->dateTime('date_of_publishing');
            $table->bigInteger('product_id');
            $table->timestamps();
            // a forign key should be done here on the user

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
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
        Schema::dropIfExists('products_comments');
    }
}
