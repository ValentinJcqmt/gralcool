<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    //Relations
    public function place_type()
    {
        return $this->belongsTo('App\PlaceType');
    }
    public function visits()
    {
        return $this->hasMany('App\Visit');
    }
    public function place_user_virtues()
    {
        return $this->hasMany('App\PlaceUserVirtue');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'id_type', 'lat', 'lng'
    ];

}
