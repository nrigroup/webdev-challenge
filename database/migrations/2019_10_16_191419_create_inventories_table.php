<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid')->index();
            $table->date('date');
            $table->string('category');
            $table->string('title');
            $table->string('location');
            $table->string('condition');
            $table->double('pre_tax', 8, 2);
            $table->string('tax_name');
            $table->double('tax_amount', 8, 2);
            $table->timestamps();

            $table->index(['category', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
