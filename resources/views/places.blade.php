@extends('base')

@section('content')

    @foreach($query as $data)
        {{$data->name}}, {{$data->lat}}, {{$data->lng}}, {{$data->note}}
        <br>
    @endforeach

@endsection

@section('title')

    Lieux

@endsection
