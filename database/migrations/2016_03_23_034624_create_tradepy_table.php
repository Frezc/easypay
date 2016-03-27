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
            $table->integer('pay_user_id');
            $table->integer('receive_user_id');
            $table->double('money', 14, 2); // 交易金额
            $table->timestamps();

            $table->index(['pay_user_id', 'receive_user_id']);
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
