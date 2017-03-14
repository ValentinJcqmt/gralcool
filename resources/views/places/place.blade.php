@extends('base')

@section('content')

    Nom: {{$place->name}}<br>
    Type: {{$place->type}}<br>
    Latitude: {{$place->lat}}<br>
    Longitude: {{$place->lng}}<br>
    Prix: {{$place->getAverageNotes()['n_price']}}<br>
    Qualité: {{$place->getAverageNotes()['n_quality']}}<br>
    Quantité: {{$place->getAverageNotes()['n_quantity']}}<br>
    Ambiance: {{$place->getAverageNotes()['n_ambiance']}}<br>
    Moyenne: {{$place->getAverageNotes()['average']}}<br>
    <a href="{{ route('editPlace', $place->id) }}">Modifier</a>

@endsection

@section('title')

    Gralcool - {{$place->name}}

@endsection
