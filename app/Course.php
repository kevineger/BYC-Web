<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Course
 *
 * @property-read \App\School $school
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comments
 * @property integer $id
 * @property integer $school_id
 * @property string $name
 * @property string $description
 * @property boolean $active
 * @property integer $min_age
 * @property integer $max_age
 * @property float $price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Course whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Course whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Course whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Course whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Course whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Course whereMinAge($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Course whereMaxAge($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Course wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Course whereUpdatedAt($value)
 */
class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
        protected $fillable = [
        'name',
        'school_id',
        'description',
        'active',
        'min_age',
        'max_age',
        'price',
    ];

    /**
     * A Course belongs to a School.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function school()
    {
        return $this->belongsTo('App\School');
    }

    /**
     * A Course has many Categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    /**
     * A Course has many comments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function times()
    {
        return $this->belongsToMany('App\Time');
    }
}
