<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommissionHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commission_history', function (Blueprint $table) {
            $table->increments('id');
            $table->string('commission_type');
            $table->integer('receiver_id')->unsigned()->index();
            $table->string('description');
            $table->float('amount');
            $table->dateTime('issue_date');

            $table
                ->foreign('receiver_id')
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
        Schema::dropIfExists('commission_history');
    }
}
