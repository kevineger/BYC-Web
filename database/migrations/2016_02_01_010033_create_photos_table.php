<?php

use App\Photo;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('photoable_id')->unsigned();
            $table->string('photoable_type');
            $table->string('name');
            $table->string('path');
            $table->string('thumbnail_path');
            $table->integer('size');
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
        // Remove any images.
        foreach (Photo::all() as $photo)
        {
            File::delete(public_path() . '/' . $photo->path);
            File::delete(public_path() . '/' . $photo->thumbnail_path);
        }
        Schema::drop('photos');
    }
}
