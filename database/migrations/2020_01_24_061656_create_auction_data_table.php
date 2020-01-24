<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->timestamp('date');
            $table->string('category');
            $table->string('lot_title');
            $table->string('lot_location');
            $table->string('lot_condition');
            $table->double('pre_tax_amount');
            $table->string('tax_name');
            $table->double('tax_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auction_data');
    }
}
