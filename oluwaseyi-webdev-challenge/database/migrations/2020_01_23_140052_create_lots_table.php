<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->require();
            $table->string('category')->require();
            $table->string('lot_title')->require();
            $table->string('lot_location')->require();
            $table->string('lot_condition')->require();
            $table->float('pre_tax_amount')->require();
            $table->string('tax_name')->require();
            $table->float('tax_amount')->require();
            $table->string('total_spending')->require();
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
        Schema::dropIfExists('lots');
    }
}
