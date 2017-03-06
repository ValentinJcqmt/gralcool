<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotesController extends Controller
{
    public function getNoteFromPlaces(){
        $query = DB::table('places')
            ->leftjoin('visits', 'places.id', '=', 'visits.id_place')
            ->join('notes', 'visits.id', '=', 'notes.id_visit')
            ->select('places.id', 'places.name', 'places.lat', 'places.lng', DB::raw('sum(notes.n_price + notes.n_quantity + notes.n_quality + notes.n_ambient)/(4*count(places.id)) as note'))
            ->groupBy('places.id', 'places.name', 'places.lat', 'places.lng')
            ->get();

        return view('places', ['query' => $query]);
    }
}
