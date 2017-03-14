<?php

namespace App\Http\Controllers;

use App\Jobs\UpdatePlaceNotes;
use App\Note;
use App\Place;
use App\User;
use App\Visit;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    /**
     * Return visits that a user didn't noted yet
     * @param Int $userId
     * @return Collection
     */
    public function getUnnotedVisitsFromUser($userId){
        $visits = Visit::where('user_id', '=', $userId)->where('noted', '=', false)->get();
        return $visits;
    }

    /**
     * Get unnoted visits of the current user and return the wiew to note them
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addNotesFromUserVisits(){
        $visits = Visit::where('user_id', '=', Auth::user()->id)->get();
        $unnotedVisitsData = Array();
        $notedVisitsData = Array();
        foreach ($visits as $visit){
            $place = Place::find($visit->place_id);
            $date = date_parse($visit->date);
            $tmpArray = [
                'year' => $date['year'],
                'month' => $date['month'],
                'day' => $date['day'],
                'placeName' => $place->name,
                'placeId' => $place->id,
                'notes' => null
            ];
            if($visit->noted){
                $tmpArray['notes'] = [
                    'n_quality' => $visit['notes']['n_quality'],
                    'n_quantity' => $visit['notes']['n_quantity'],
                    'n_price' => $visit['notes']['n_price'],
                    'n_ambiance' => $visit['notes']['n_ambiance'],
                    'average' => $visit['notes']['average'],
                ];
                $notedVisitsData[$visit->id] = $tmpArray;
            }
            else
                $unnotedVisitsData[$visit->id] = $tmpArray;
        }

        return view('visits.visitsForms', ['unnoted' => $unnotedVisitsData, 'noted' => $notedVisitsData]);
    }

    public function saveNoteFromVisit(Request $request){
        $id = $request->get('id');
        $average = (
            $request->get('n_quality-'.$id)
            +$request->get('n_quantity-'.$id)
            +$request->get('n_price-'.$id)
            +$request->get('n_ambiance-'.$id)
        )/4;
        $note = new Note([
            'visit_id' => $id,
            'n_quality' => $request->get('n_quality-'.$id),
            'n_quantity' => $request->get('n_quantity-'.$id),
            'n_price' => $request->get('n_price-'.$id),
            'n_ambiance' => $request->get('n_ambiance-'.$id),
            'average' => $average,
        ]);
        $note->save();

        $visit = Visit::find($id);
        $visit->noted = true;
        $visit->save();

        $place = Place::find($visit->place_id);

        dispatch(new UpdatePlaceNotes($place));

        return redirect()->route('visits');
    }

    public function addNewVisit(){
        $users = User::all();
        $places = Place::all();

        return view('visits.addVisit', ['users' => $users, 'places' => $places]);
    }

    public function saveNewVisit(request $request){
        dd($request);
    }
}
