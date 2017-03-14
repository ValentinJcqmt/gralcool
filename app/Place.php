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
        'name', 'type_id', 'lat', 'lng', 'n_price', 'n_quality', 'n_quantity', 'n_ambiance', 'average'
    ];

    protected $guarded = array('id');



    /**
     * Calculate the average notes from all visits on this place
     */
    public function updateAverageNotes(){
        $visits = Visit::where('place_id', '=', $this->id)->with('notes')->get()->filter(function($var){ return $var->noted; });

        if(empty($visits)){
            $this->n_price = $this->n_quality = $this->n_quantity = $this->n_ambiance = $this->average = null;
        }
        else{
            $avg = [
                'n_price' => 0,
                'n_quality' => 0,
                'n_quantity' => 0,
                'n_ambiance' => 0,
                'average' => 0
            ];
            foreach ($visits as $visit){
                $avg['n_price'] += $visit->notes->attributesToArray()['n_price'];
                $avg['n_quality'] += $visit->notes->attributesToArray()['n_quality'];
                $avg['n_quantity'] += $visit->notes->attributesToArray()['n_quantity'];
                $avg['n_ambiance'] += $visit->notes->attributesToArray()['n_ambiance'];
                $avg['average'] += $visit->notes->attributesToArray()['average'];
            }
            foreach($avg as $n_type => $note){
                $this[$n_type] = round($avg[$n_type] / count($visits), 1);
            }
        }
    }

    /**
     * Get the average notes of the place and return them
     * @return array
     */
    public function getAverageNotes(){
        $notes = [
            'n_price' => $this->n_price,
            'n_quality' => $this->n_quality,
            'n_quantity' => $this->n_quantity,
            'n_ambiance' => $this->n_ambiance,
            'average' => $this->average
        ];

        foreach($notes as $n_type => $note){
            if(is_null($note))
                $notes[$n_type] = 'Pas de note enregistrée à ce jour';
        }

        return $notes;
    }

}
