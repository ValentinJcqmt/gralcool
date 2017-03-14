@extends('base')

@section('content')

    <form method="POST">
        {{Form::token()}}
        @if(isset($users))
            <select name="users[]" class="selectpicker" multiple="">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        @endif
        @if(isset($places))
            <select id="places" name="places" class="selectpicker" data-live-search="true">
                @foreach($places as $place)
                    <option value="{{$place->id}}">{{$place->name}}</option>
                @endforeach
            </select>
        @endif
        <input type="submit" class="btn btn-default" value="Enregistrer" name="submit-" >
    </form>

@endsection

@section('title')

    Gralcool - Mes notes

@endsection
