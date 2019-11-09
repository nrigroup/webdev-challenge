<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auction_awards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('auctionDate');
            $table->string('category');
            $table->string('lotTitle');
            $table->string('lotLocation');
            $table->string('lotCondition');
            $table->decimal('preTaxAmount',9,3);
            $table->string('taxName');
            $table->decimal('taxAmount',9,3);
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
        Schema::dropIfExists('auction_awards');
    }
}
