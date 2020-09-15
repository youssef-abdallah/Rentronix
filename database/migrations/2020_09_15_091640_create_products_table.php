<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->engine = ' MyISAM' ; // to remove error SQLSTATE[HY000]: General error: 1215

            $table->bigIncrements('id');
            $table->string('name');
            $table->string(' product_overview');
            $table->string(' datasheet_url');
            $table->string(' image_url');
            $table->unsignedInteger(' available_stock');
            $table->unsignedInteger(' rental_price');
            $table->unsignedInteger(' selling_price');
            $table-> bigInteger('subcategory_id');
            $table->timestamps();
            // a forign key should be done here on the user "manufacture type"

            $table->foreign('subcategory_id')
                ->references('id')
                ->on('subcategories')
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
}
