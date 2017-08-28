<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->string('category');
            $table->string('lot_title');
            $table->string('lot_location');
            $table->string('lot_condition');
            $table->float('pre_tax_amount', 8,2);
            $table->string('tax_name');
            $table->float('tax_amount', 8,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('auctions');
    }
}
