<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImportCsv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ( 'lotData', function ($table) {
            $table->increments ( 'id' );
            $table->date ( 'date' );
            $table->string ( 'category' );
            $table->string ( 'lot_title' );
            $table->string ( 'lot_location' );
            $table->string ( 'lot_condition' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
