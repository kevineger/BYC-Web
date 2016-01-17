<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\School
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Course[] $courses
 * @property-read \App\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\SchoolPhoto[] $photos
 * @method static \Illuminate\Database\Query\Builder|\App\School search($search)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 */
class School extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'address',
        'user_id',
    ];

    /**
     * A School has many Courses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    /**
     * A School belongs to a User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * A school is owned by a user.
     *
     * @param $related
     * @return bool
     */
    public function owns($related)
    {
        return $this->id == $related->school_id;
    }

    /**
     * A School has many comments through a polymorphic relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    /**
     * A school has many photos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\SchoolPhoto');
    }

    /**
     * Add a photo to the School model.
     *
     * @param SchoolPhoto $photo
     * @return Model
     */
    public function addPhoto(SchoolPhoto $photo)
    {
        return $this->photos()->save($photo);
    }

    /**
     * Query scope for searching a school by title.
     *
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', "%$search%");
    }
}
