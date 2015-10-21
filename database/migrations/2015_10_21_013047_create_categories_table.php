<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->timestamps();
        });

        Schema::create('categories_courses', function (Blueprint $table) {
            // Categories relation
            $table->integer('categories_id')
                ->references('id')
                ->on('categories');
            // Courses relation
            $table->integer('courses_id')
                ->references('id')
                ->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories_courses');
        Schema::drop('categories');
    }
}
