<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $missingNotes = app('App\Http\Controllers\VisitController')->getUnnotedVisitsFromUser(Auth::user()->id);
        $plurial = '';
        if(count($missingNotes) > 1) $plurial = 's';
        return view('home', ['missingNotes' => $missingNotes, 'plurial' => $plurial]);
    }
}
