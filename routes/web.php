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

Route::get('/visit', function () {
    return view('visit');
});

Route::get('/visit/ajout', function () {
    return view('addVisit');
});

Route::get('/lieux', 'NotesController@getNoteFromPlaces');

Route::get('/lieu/{id}', function ($id) {
    return view('place', ['id' => $id]);
});

Route::get('/lieu/ajout', function () {
    return view('addPlace');
});
