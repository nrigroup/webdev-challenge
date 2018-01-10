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
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('date');
            $table->string('category', 100);
            $table->string('lot_title');
            $table->string('lot_location');
            $table->string('lot_condition');
            $table->string('pre_tax_amount');
            $table->string('tax_name');
            // Using string instead of float to avoid possible truncate errors
            $table->string('tax_amount', 255); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
