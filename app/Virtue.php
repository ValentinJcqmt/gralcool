<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Virtue extends Model
{
    //Relations
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
        'name',
    ];
}
