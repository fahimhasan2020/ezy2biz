<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('applicant_id')->unsigned()->index();
            $table->float('amount');
            $table->string('bkash_no')->index();
            $table->string('response')->default('pending')->index();
            $table->timestamp('timestamp');

            $table->foreign('applicant_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('point_requests');
    }
}
