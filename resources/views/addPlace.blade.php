@extends('base')

@section('content')

    <form method="POST">
        {{Form::token()}}
        <input type="text" name="name" placeholder="Nom de l'enseigne">
        <input type="submit" name="Enregistrer">
    </form>

@endsection

@section('title')

    Gralcool - Ajouter un lieu

@endsection
