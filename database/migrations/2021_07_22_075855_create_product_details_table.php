<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignid('product_id')->constrained();
            $table->foreignid('purchase_item_id')->constrained()->cascadeOnDelete();
            $table->string('batch');
            $table->unsignedBigInteger('quantity');
            $table->string('sp');
            $table->string('mrp');
            $table->foreignid('purchase_id')->constrained();
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
        Schema::dropIfExists('product_details');
    }
}
