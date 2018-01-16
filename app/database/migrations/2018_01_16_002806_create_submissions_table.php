<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('location')->nullable();
            $table->string('category')->nullable();
            $table->string('condition')->nullable();
            $table->datetime('date')->nullable();
            $table->string('tax_name')->nullable();
            $table->integer('pre_tax')->nullable();
            $table->decimal('tax_amount', 8,2)->nullable();
            $table->decimal('total', 8,2)->nullable();
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
        Schema::dropIfExists('submissions');
    }
}
