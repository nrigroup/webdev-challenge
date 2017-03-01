<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('items', function (Blueprint $table) {
          $table->increments('id');
          $table->date('date');
          $table->string('category', 150);
          $table->string('lot_title', 100);
          $table->string('lot_location', 100);
          $table->string('lot_condition', 100);
          $table->string('pre_tax_amount');
          $table->string('tax_name', 100);
          $table->string('tax_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('items');
    }
}
