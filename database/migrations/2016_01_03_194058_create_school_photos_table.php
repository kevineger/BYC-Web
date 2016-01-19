<?php

use App\SchoolPhoto;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolPhotosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_photos', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->string('name');
            $table->string('path');
            $table->string('thumbnail_path');
            $table->integer('size');
            $table->timestamps();

            $table->foreign('school_id')
                ->references('id')
                ->on('schools')
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
        // Remove any images.
        foreach (SchoolPhoto::all() as $photo)
        {
            File::delete(public_path() . '/' . $photo->path);
            File::delete(public_path() . '/' . $photo->thumbnail_path);
        }
        Schema::drop('school_photos');
    }
}
