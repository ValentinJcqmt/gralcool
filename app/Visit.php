<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    //Relations
    public function notes()
    {
        return $this->hasOne('App\Note');
    }
    public function place()
    {
        return $this->belongsTo('App\Place');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'place_id', 'date',
    ];
}
