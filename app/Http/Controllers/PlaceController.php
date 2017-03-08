<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Integer;

class PlaceController extends Controller
{

    public function getAllPlaces(){
        $places = Place::all();

        return view('places', ['places' => $places]);
    }

    public function getPlace($id){
        $place = Place::find($id);

        return view('place', ['place' => $place]);
    }

    public function addNewPlace(Request $request){
        $name = $request->get('name');
        $place = factory(Place::class)->create([
            'name' => $name
        ]);
        $place->save();
        $newPlaceId = Place::where('name', '=', $name)->get()->first()->attributesToArray()['id'];
        return redirect()->route('onePlace', ['id' => $newPlaceId]);
    }

    public function editPlace($id){
        $place = Place::find($id);

        return view('editPlace', ['place' => $place]);
    }

    public function saveEditPlace(Request $request){
        $id = $request->get('id');

        $place = Place::find($id);

        $place->name = $request->get('name');
        $place->lat = $request->get('lat');
        $place->lng = $request->get('lng');

        $place->save();

        return redirect()->route('onePlace', ['id' => $id]);
    }
}