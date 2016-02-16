<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('time_id')->unsigned();
            $table->integer('quantity');
            $table->decimal('subtotal', 8, 2);

            $table->foreign('payment_id')
                ->references('id')
                ->on('payments')
                ->onDelete('cascade');
            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');
            $table->foreign('time_id')
                ->references('id')
                ->on('times')
                ->onDelete('cascade');

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
        Schema::drop('purchases');
    }
}
