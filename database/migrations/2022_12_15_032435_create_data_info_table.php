<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->string('category');
            $table->string('lot_title');
            $table->string('lot_location');
            $table->string('lot_condition');
            $table->integer('pre_tax_amount');
            $table->integer('tax_amount');
            $table->string('tax_name');
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
        Schema::dropIfExists('data_infos');
    }
}
