<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Time[] $times
 * @method static \Illuminate\Database\Query\Builder|\App\Course search($search)
 */
class Course extends Model {

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
     * Get all of a course's photos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

    /**
     * Add a photo to the Course model.
     *
     * @param Photo $photo
     * @return Model
     */
    public function addPhoto(Photo $photo)
    {
        return $this->photos()->save($photo);
    }

    /**
     * A Course has many comments through a polymorphic relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    /**
     * Query scope for searching a course.
     *
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', "%$search%")->orWhere('description', 'LIKE', "%$search%");
    }

    /**
     * Query scope for active courses.
     *
     * @return mixed
     */
    public function scopeActive()
    {
        return $this->where('active', true);
    }

    /**
     * Get all times for a course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function times()
    {
        return $this->belongsToMany('App\Time')->withPivot(['num_seats', 'num_reg']);
    }

    /**
     * Return a nice even number slightly cheaper than the cheapest course.
     *
     * @return mixed
     */
    public static function cheapest()
    {
        return floor((float)Course::min('price'));
    }

    /**
     * Return a nice even number slightly higher than the most expensive course.
     *
     * @return mixed
     */
    public static function expensive()
    {
        return floor((float)Course::max('price'));
    }

    /**
     * A Course has many Purchases.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }

    /**
     * Query scope for featured Course.
     *
     * @return mixed
     */
    public function scopeFeatured()
    {
        return $this->where('featured',1);
    }

    /**
     * Get a list of category ids associated with the current Course.
     *
     * @return array
     */
    public function getCategoryListAttribute()
    {
        return $this->categories->lists('id')->toArray();
    }

    /**
     * Query scope for times with end date's after today.
     *
     * @return mixed
     */
    public function scopePresentTimes()
    {
        return $this->whereHas('times', function ($q)
        {
            $q->where('end_date', '>=', Carbon::now());
        });
    }
}
