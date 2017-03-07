<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{

    public function getAllPlaces(){
        $places = Place::all();

        return view('places', ['places' => $places]);
    }

    public function getPlace($id){
        $place = Place::find($id);
        dd($place);
    }
}
