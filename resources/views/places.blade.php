@extends('base')

@section('content')

    @foreach($places as $place)
        {{$place->getAverageNotes()['average']}}
        <br>
    @endforeach

@endsection

@section('title')

    Lieux

@endsection
