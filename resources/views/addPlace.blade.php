@extends('base')

@section('content')

    <form method="POST">
        {{Form::token()}}
        <input type="text" name="name" placeholder="Nom de l'enseigne">
        <select name="type">
            @foreach($types as $type)

                <option value="{{$type->id}}">{{$type->name}}</option>

            @endforeach
        </select>
        <input type="submit" name="Enregistrer">
    </form>

@endsection

@section('title')

    Gralcool - Ajouter un lieu

@endsection
