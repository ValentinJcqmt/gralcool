<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\Float_;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Cast\Int_;

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

    protected $guarded = array('id');



    /**
     * @return array
     */
    public function getAverageNotes(){

        $visits = Visit::where('place_id', '=', $this->id)->with('notes')->get();

        $avg = [
            'n_price' => 'Pas de note enregistrée à ce jour',
            'n_quality' => 'Pas de note enregistrée à ce jour',
            'n_quantity' => 'Pas de note enregistrée à ce jour',
            'n_ambiance' => 'Pas de note enregistrée à ce jour',
            'average' => 'Pas de note enregistrée à ce jour'
        ];

        if(count($visits) > 0){

            foreach($avg as $n_type => $note){
                $avg[$n_type] = 0;
            }

            foreach($visits as $visit){
                $avg['n_price'] += $visit->notes->attributesToArray()['n_price'];
                $avg['n_quality'] += $visit->notes->attributesToArray()['n_quality'];
                $avg['n_quantity'] += $visit->notes->attributesToArray()['n_quantity'];
                $avg['n_ambiance'] += $visit->notes->attributesToArray()['n_ambiance'];
                $avg['average'] += $visit->notes->attributesToArray()['average'];
            }

            foreach($avg as $n_type => $note){
                $avg[$n_type] /= count($visits);
            }

        }

        return ($avg);

    }

}
