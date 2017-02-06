<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
            Uploads table
            Tracks CSV uploads
            For the purposes of this demo, it uses IP address as the user ID (would normally use user ID for auditing/tracking purposes)
        */

        Schema::create('uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('timestamp');
            $table->string('filename');
            $table->ipAddress('userID');
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
        Schema::drop('uploads');
    }
}
