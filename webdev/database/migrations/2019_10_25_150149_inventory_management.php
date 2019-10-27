<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InventoryManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Category schema
        Schema::create('inventory_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('inventory_category');
            $table->timestamps();
        });

        // Inventory_condition
        Schema::create('inventory_condition', function (Blueprint $table) {
            $table->increments('id');
            $table->string('inventory_condition');
            $table->timestamps();
        });

        // Tax category management
        Schema::create('tax', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tax_name');
            $table->float('tax_rule')->nullable();
            $table->timestamps();
        });

        // Inventory
        Schema::create('inventory', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->unsignedInteger('category_id');
            $table->string('lot_title');
            $table->text('lot_location');
            $table->unsignedInteger('lot_condition_id');
            $table->unsignedInteger('tax_name');
            $table->bigInteger('tax_amount');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('category_id')->references('id')->on('inventory_category')->onDelete('cascade');
            $table->foreign('lot_condition_id')->references('id')->on('inventory_condition')->onDelete('cascade');
            $table->foreign('tax_name')->references('id')->on('tax')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('inventory_category');
        Schema::dropIfExists('inventory_condition');
        Schema::dropIfExists('tax');
        Schema::dropIfExists('inventory');
    }
}
