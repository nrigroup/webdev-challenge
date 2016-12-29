<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTbl extends Migration
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
            $table->datetime('date');
            $table->text('category');
            $table->text('lot_title');
            $table->text('lot_location');
            $table->text('lot_condition');
            $table->decimal('pre_tax_amount');
            $table->text('tax_name');
            $table->decimal('tax_amount');            
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
        Schema::drop("items");
    }
}
