<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dashboards', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->text('date')->nullable(false)->change();
            $table->text('category')->nullable(false)->change();
            $table->text('lot title')->nullable(false)->change();
            $table->text('lot location')->nullable(false)->change();
            $table->text('lot condition')->nullable(false)->change();
            $table->double('pre-tax amount')->nullable(false)->change();
            $table->text('tax name');
            $table->double('tax amount');
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
        Schema::dropIfExists('dashboards');
    }
};
