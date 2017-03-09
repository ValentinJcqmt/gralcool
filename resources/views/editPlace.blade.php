@extends('base')

@section('content')

    <form action="" method="POST">
        {{Form::token()}}
        <input type="text" name="name" placeholder="Nom de l'enseigne" value="{{$place->name}}">
        <input type="text" name="lat" placeholder="Nom de l'enseigne" value="{{$place->lat}}">
        <input type="text" name="lng" placeholder="Nom de l'enseigne" value="{{$place->lng}}">
        <select name="type">
            @foreach($types as $type)

                <option value="{{$type->id}}" @if($type->id == $place->type_id) selected="selected" @endif >{{$type->name}}</option>

            @endforeach
        </select>
        <input type="hidden" name="id" value="{{$place->id}}">
        <input type="submit" name="Enregistrer">
    </form>

@endsection

@section('title')

    Gralcool - Modification de "{{$place->name}}"

@endsection
