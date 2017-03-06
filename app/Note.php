<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //Relations
    public function visit()
    {
        return $this->belongsTo('App\Visit');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'visit_id', 'n_price', 'n_quality', 'n_quantity', 'n_ambiant'
    ];
}
