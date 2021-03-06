<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceUserVirtue extends Model
{
    //Relations
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function place()
    {
        return $this->belongsTo('App\Place');
    }
    public function virtue()
    {
        return $this->belongsTo('App\Virtue');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'virtue_id', 'place_id', 'user_id',
    ];

    protected $guarded = array('id');
}
