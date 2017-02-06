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

    /*
        Items
        Tracks items imported from CSV
        Date, category, lot title, location, condition, pre-tax amount, tax name, tax amount
    */

        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uploadid')->unsigned();
            $table->foreign('uploadid')->references('id')->on('uploads');
            $table->date('date');
            $table->string('category');
            $table->string('lot_title');
            $table->string('lot_location');
            $table->string('lot_condition');
            $table->decimal('pretax_amount', 10, 2);
            $table->string('tax_name');
            $table->decimal('tax_amount', 10, 2);
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
