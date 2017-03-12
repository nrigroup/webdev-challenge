<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lot', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('location');
            $table->string('condition');
            $table->int('category_id');
            $table->int('uploader_id');
            $table->int('tax_id');
            $table->int('file_id');
            $table->string('tax_amount');
            $table->string('pre_tax');
            $table->string('date');
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
        Schema::table('lot', function (Blueprint $table) {
            Schema::dropIfExists('lot');
        });
    }
}
