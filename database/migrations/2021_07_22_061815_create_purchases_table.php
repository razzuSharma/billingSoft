<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->string('invoice_no');
            $table->foreignid('supplier_id')->constrained();
            $table->enum('status', ['Running', 'Completed', 'Cancelled']);
            $table->enum('purchase_type', ['Direct', 'Order', 'Return']);
            $table->foreignid('user_id')->constrained();
            $table->string('shipping_cost')->default('0');
            $table->string('adjustable_discount')->default('0');
            $table->string('remark');
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
        Schema::dropIfExists('purchases');
    }
}
