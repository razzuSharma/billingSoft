<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignid('sale_id')->constrained();
            $table->foreignid('product_detail_id')->constrained();
            $table->string('quantity');
            $table->string('rate');
            $table->string('amount');
            $table->string('discount_percent')->default('0');
            $table->string('discount_amount')->default('0');
            $table->string('profit_per_item')->default('0');
            $table->string('total_profit')->default('0');
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
        Schema::dropIfExists('sale_orders');
    }
}
