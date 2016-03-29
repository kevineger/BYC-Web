<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model {

    protected $fillable = [
        'name',
        'path'
    ];

    /**
     * Get the first banner by name.
     *
     * @param $name
     */
    public static function findByName($name)
    {
        return Banner::where('name', $name)->firstOrFail();
    }

    /**
     * Checks if a banner was set.
     * 
     * @return bool
     */
    public function bannerSet()
    {
        return $this->path != "";
    }
}
