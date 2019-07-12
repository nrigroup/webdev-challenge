<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable(false);
            $table->string('address')->nullable(false);
            $table->date('purchase_date')->nullable(false);
            $table->decimal('pre_tax_amount', 8, 2)->nullable(false);
            $table->decimal('tax_amount', 8, 2)->nullable(false);

            //Foreign keys

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');

            $table->unsignedBigInteger('tax_type_id');
            $table->foreign('tax_type_id')
                ->references('id')->on('tax_types')
                ->onDelete('cascade');

            $table->unsignedBigInteger('condition_id');
            $table->foreign('condition_id')
                ->references('id')->on('conditions')
                ->onDelete('cascade');

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
        Schema::dropIfExists('items');
    }
}
