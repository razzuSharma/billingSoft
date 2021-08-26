<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('invoice_no');
            $table->foreignid('customer_id')->constrained();
            $table->foreignid('user_id')->constrained();
            $table->enum('sales_type', ['Cash', 'Credit']);
            $table->enum('status', ['Pending', 'Completed', 'Return']);
            $table->string('total_amount')->default('0');
            $table->string('discount_amount')->default('0');
            $table->string('shipping_cost')->default('0');
            $table->string('adjustable_discount')->default('0');
            $table->string('net_amount')->default('0');
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
        Schema::dropIfExists('sales');
    }
}
