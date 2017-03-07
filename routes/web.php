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

Route::get('/', function () {

    return view('home');
});


Route::get('/user', function () {
    return view('user');
});

Route::get('/user/{id}', function ($id) {
    return view('user', ['id' => $id]);
});

Route::get('/note', function () {
    return view('note');
});

Route::get('/visits', function () {
    return view('visit');
});

Route::get('/visits/add', function () {
    return view('addVisit');
});

Route::get('/lieux', 'PlaceController@getAllPlaces');

Route::get('/lieux/{id}', 'PlaceController@getPlace');

Route::get('/lieux/add', function () {
    return view('addPlace');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
