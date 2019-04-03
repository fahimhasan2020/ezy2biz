<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buyer_id')->unsigned()->index();
            $table->string('product_name');
            $table->float('sale_price');
            $table->float('wholesale_price');
            $table->float('commission');
            $table->integer('quantity')->unsigned();
            $table->float('total_cost');
            $table->string('order_status')->default('pending')->index();
            $table->timestamp('ordered_at');

            $table->foreign('buyer_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_orders');
    }
}
