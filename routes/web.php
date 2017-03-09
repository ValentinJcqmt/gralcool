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


Route::get('/', function () {
    return view('home');
})->name('home');


// Places's Routes
Route::get('/places', 'PlaceController@getAllPlaces')->name('places');


Route::get('/places/add', 'PlaceController@addNewPlace')->name('addPlace');
Route::post('/places/add', 'PlaceController@saveNewPlace')->name('savePlace');

Route::get('/places/{id}/edit', 'PlaceController@editPlace')->name('editPlace');
Route::post('/places/{id}/edit', 'PlaceController@saveEditPlace')->name('saveEditPlace');

Route::get('/places/{id}', 'PlaceController@getPlace')->name('onePlace');






Route::get('/user', function () {
    return view('user');
})->name('user');


Route::get('/user/{id}', function ($id) {
    return view('user', ['id' => $id]);
})->name('oneUser');


Route::get('/note', function () {
    return view('note');
})->name('note');


Route::get('/visits', function () {
    return view('visit');
})->name('visits');


Route::get('/visits/add', function () {
    return view('addVisit');
})->name('addVisit');





Route::get('/home', 'HomeController@index');
