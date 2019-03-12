<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEzy2bizDbTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('address');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('parent_id')->unsigned()->index();
            $table->integer('referrer_id')->unsigned()->index();
            $table->tinyInteger('step');
            $table->float('point');
            $table->boolean('is_active');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->float('sale_price');
            $table->float('wholesale_price');
            $table->float('commission');
            $table->text('image_paths');
        });

        Schema::create('bulletins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->date('publish_date');
            $table->integer('publisher_id')->unsigned()->index();

            $table
                ->foreign('publisher_id')
                ->references('id')
                ->on('admins')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('referral_tree', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('child_id')->unsigned();
            $table->tinyInteger('level');
            $table->primary(['user_id', 'child_id']);

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table
                ->foreign('child_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });

        Schema::create('cron_job_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_type');
            $table->integer('issuer_id')->unsigned();
            $table->date('issue_date');
            $table->time('issue_time');
            $table->string('job_status');

            $table
                ->foreign('issuer_id')
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
        Schema::dropIfExists('cron_job_schedules');
        Schema::dropIfExists('referral_tree');
        Schema::dropIfExists('bulletins');
        Schema::dropIfExists('products');
        Schema::dropIfExists('users');
        Schema::dropIfExists('admins');
    }
}
