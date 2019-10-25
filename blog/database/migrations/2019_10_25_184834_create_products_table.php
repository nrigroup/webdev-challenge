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
          $table->bigIncrements('id');
                       $table->date('date')->nullable();
                       $table->string('category',250)->nullable();
                       $table->string('lot_title',250)->nullable();
                       $table->string('lot_location',250)->nullable();
                       $table->string('lot_condition',250)->nullable();
                       $table->float('pre_tax_amount')->nullable();
                       $table->string('tax_name',250)->nullable();
                       $table->float('tax_amount')->nullable();
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
        Schema::dropIfExists('products');
    }
}
