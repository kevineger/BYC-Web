<?php

use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('time_of_day')->default(Carbon::now()->month(0)->second(0));
            $table->boolean('mon');
            $table->boolean('tues');
            $table->boolean('wed');
            $table->boolean('thurs');
            $table->boolean('fri');
            $table->boolean('sat');
            $table->boolean('sun');
            $table->dateTime('beginning_date')->default(Carbon::now()->startOfDay());
            $table->dateTime('end_date')->default(Carbon::now()->addMonth());
            $table->char('repeats')->default(null);
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
        Schema::drop('times');
    }
}
