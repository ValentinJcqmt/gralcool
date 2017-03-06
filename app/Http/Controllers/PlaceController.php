<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    public function getNoteFromPlaces(){
        $place = Place::find(5);
        dd($place->getAverageNote());

        return view('places', ['query' => $query]);
    }

    public function getPlace($id){
        $place = Place::with('visits');
        dd($place);
    }
}
