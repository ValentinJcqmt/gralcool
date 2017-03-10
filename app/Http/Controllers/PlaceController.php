<?php

namespace App\Http\Controllers;

use App\Place;
use App\PlaceType;
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
        $place->type = PlaceType::find($place->type_id)->name;

        return view('place', ['place' => $place]);
    }

    public function addNewPlace(){
        $types = PlaceType::all();

        return view('addPlace', ['types' => $types]);
    }

    public function saveNewPlace(Request $request){
        $name = $request->get('name');
        $place = factory(Place::class)->create([
            'name' => $name,
            'type_id' => $request->get('type'),
            'lat' => floatval($request->get('lat')),
            'lng' => floatval($request->get('lng'))
        ]);
        $place->save();
        $newPlaceId = Place::where('name', '=', $name)->get()->first()->attributesToArray()['id'];
        return redirect()->route('onePlace', ['id' => $newPlaceId]);
    }

    public function editPlace($id){
        $place = Place::find($id);
        $types = PlaceType::all();

        return view('editPlace', ['place' => $place, 'types' => $types]);
    }

    public function saveEditPlace(Request $request){
        $id = $request->get('id');

        $place = Place::find($id);

        $place->name = $request->get('name');
        $place->lat = $request->get('lat');
        $place->lng = $request->get('lng');
        $place->type_id = $request->get('type');

        $place->save();

        return redirect()->route('onePlace', ['id' => $id]);
    }
}