<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->string('name');
            $table->mediumText('description');
            $table->boolean('active')->default(false);
            $table->integer('min_age');
            $table->integer('max_age');
            $table->decimal('price', 8, 2);
            $table->timestamps();

            $table->foreign('school_id')
                ->references('id')
                ->on('schools')
                ->onDelete('cascade');
        });

        Schema::create('course_time', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->integer('time_id')->unsigned();
            $table->integer('num_avail')->unsigned();
            $table->integer('num_reg')->unsigned();

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
        Schema::drop('course_time');
        Schema::drop('courses');
    }
}
