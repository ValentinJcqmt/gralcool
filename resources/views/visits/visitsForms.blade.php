@extends('base')

@section('content')

    @foreach($unnoted as $visitId => $visit)
        Visite le {{$visit['day']}}-{{$visit['month']}}-{{$visit['year']}}
        A <a href="{{ route('onePlace', $visit['placeId']) }}"><b>{{$visit['placeName']}}</b></a> :
        <form method="POST">
            {{Form::token()}}
            Qualité: <input min="0.0" max="20.0" type="number" step="0.1" name="n_quality-{{$visitId}}">
            Quantité: <input min="0.0" max="20.0" type="number" step="0.1" name="n_quantity-{{$visitId}}">
            Prix: <input min="0.0" max="20.0" type="number" step="0.1" name="n_price-{{$visitId}}">
            Ambiance: <input min="0.0" max="20.0" type="number" step="0.1" name="n_ambiance-{{$visitId}}">
            <input type="hidden" name="id" value="{{$visitId}}">
            <input type="submit" value="Enregistrer" name="submit-{{$visitId}}" >
        </form>
    @endforeach
    @foreach($noted as $visitId => $visit)
        Visite le {{$visit['day']}}-{{$visit['month']}}-{{$visit['year']}}
        A <a href="{{ route('onePlace', $visit['placeId']) }}"><b>{{$visit['placeName']}}</b></a> :
        <div>
            Qualité: {{ $visit['notes']['n_quality'] }}
            Quantité: {{ $visit['notes']['n_quantity'] }}
            Prix: {{ $visit['notes']['n_price'] }}
            Ambiance: {{ $visit['notes']['n_ambiance'] }}
            Moyenne totale: {{ $visit['notes']['average'] }}
        </div>
    @endforeach

@endsection

@section('title')

    Gralcool - Mes notes

@endsection
