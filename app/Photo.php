<?php

namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * App\SchoolPhoto
 *
 * @property integer $id
 * @property integer $school_id
 * @property string $path
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\School $school
 * @property integer $size
 * @property string $name
 * @property string $thumbnail_path
 */
class Photo extends Model {

    protected $fillable = [
        'name',
        'path',
        'thumbnail_path',
        'size'
    ];

    protected $baseDir = 'photos';

    /**
     * Get all of the owning photoable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function photoable()
    {
        return $this->morphTo();
    }

    /**
     * A photo belongs to a school.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school()
    {
        return $this->belongsTo('App\School');
    }

    /**
     * Build a new photo instance from a file upload.
     *
     * @param $name
     * @return mixed
     */
    public static function named($name)
    {
        return (new static)->saveAs($name);
    }

    protected function saveAs($name)
    {
        $this->name = sprintf("%s-%s", time(), $name);
        $this->path = sprintf("%s/%s", $this->baseDir, $this->name);
        $this->thumbnail_path = sprintf("%s/tn-%s", $this->baseDir, $this->name);

        return $this;
    }

    public function move(UploadedFile $file)
    {
        $file->move($this->baseDir, $this->name);

        $this->makeThumbnail();

        return $this;
    }

    protected function makeThumbnail()
    {
        Image::make($this->path)
            ->fit(200)
            ->save($this->thumbnail_path);
    }
}
