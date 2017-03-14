@extends('base')

@section('content')

    <a href="{{ route('addPlace') }}">Ajouter une nouvelle enseigne</a><br><br>

    @foreach($places as $place)
        Nom: <a href="{{ route('onePlace', $place->id) }}">{{$place->name}}</a><br>
        Latitude: {{$place->lat}}<br>
        Longitude: {{$place->lng}}<br>
        Moyenne: {{$place->getAverageNotes()['average']}}<br>
    @endforeach

@endsection

@section('title')

    Lieux

@endsection
