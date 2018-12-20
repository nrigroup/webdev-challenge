<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->text('date');
            $table->text('category');
            $table->text('lot_title');
            $table->text('lot_location');
            $table->text('lot_condition');
            $table->float('pre_tax_amount');
            $table->text('tax_name');
            $table->float('tax_amount');
            $table->text('auction_name');
            // $table->timestamps();
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
