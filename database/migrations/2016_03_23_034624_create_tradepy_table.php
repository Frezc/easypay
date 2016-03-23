<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradepyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradepy', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pay_user_id');
            $table->string('receive_user_id');
            $table->string('trade_py'); //交易金额
            $table->timestamp('created_at');

            $table->index('pay_user_id', 'receive_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tradepy');
    }
}
