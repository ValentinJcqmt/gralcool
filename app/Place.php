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
        'name', 'type_id', 'lat', 'lng'
    ];

    public function getAverageNote(){
        $visits = Visit::with('notes')->where('place_id', '=', $this->id)->get();

        $avgNotes = Array();

        foreach($visits as $visit){
            array_push($avgNotes, (array_sum($visit->note) / count($visit->note)));
        }


        return (array_sum($avgNotes) / count($avgNotes));
    }

}
