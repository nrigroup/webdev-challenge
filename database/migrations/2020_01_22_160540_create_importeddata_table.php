<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportedDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imported_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('category',250);
            $table->string('lot_title',250);
            $table->string('lot_location',250);
            $table->string('lot_condition',250);
            $table->decimal('pre_tax_amount',10,2)->default(0);
            $table->string('tax_name',250);
            $table->decimal('tax_amount',10,2)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('csvs');
    }
}
