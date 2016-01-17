<?php

namespace App;

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
 */
class SchoolPhoto extends Model {

    protected $fillable = [
        'path',
        'size'
    ];

    protected $baseDir = 'photos/schools';

    /**
     * A photo belongs to a school.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school()
    {
        return $this->belongsTo('App\School');
    }

    public static function fromForm(UploadedFile $file)
    {
        $photo = new static;

        $name = time() . $file->getClientOriginalName();

        $photo->path = $photo->baseDir . '/' . $name;
        $photo->size = $file->getSize();

        $file->move($photo->baseDir, $name);

        return $photo;
    }
}
