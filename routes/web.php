<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use Illuminate\Support\Facades\Auth;

Auth::routes();


//Home Route
Route::get('/', function () {
    return view('home');
})->name('home');


// Places Routes
Route::get('/places', 'PlaceController@getAllPlaces')->name('places')->middleware('auth');


Route::get('/places/add', 'PlaceController@addNewPlace')->name('addPlace')->middleware('auth');
Route::post('/places/add', 'PlaceController@saveNewPlace')->name('savePlace')->middleware('auth');

Route::get('/places/{id}/edit', 'PlaceController@editPlace')->name('editPlace')->middleware('auth');
Route::post('/places/{id}/edit', 'PlaceController@saveEditPlace')->name('saveEditPlace')->middleware('auth');

Route::get('/places/{id}', 'PlaceController@getPlace')->name('onePlace')->middleware('auth');




//Visits Routes
Route::get('/visits', 'VisitController@getVisitsForUser')->name('visits')->middleware('auth'); //TODO create controller, tests and function

Route::get('/visits/add', function () {
    return view('addVisit');
})->name('addVisit')->middleware('auth');





Route::get('/user', function () {
    return view('user');
})->name('user');


Route::get('/user/{id}', function ($id) {
    return view('user', ['id' => $id]);
})->name('oneUser');


Route::get('/note', function () {
    return view('note');
})->name('note');






Route::get('/home', 'HomeController@index');
