<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function(Blueprint $table)
        {
            $table->increments('id');
    
            $table->integer('date');
            $table->string('category');
            $table->string('title');
            $table->string('location');
            $table->string('condition');
            $table->decimal('amount');
            $table->string('tax_name');
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
        Schema::drop('items');
    }
}
