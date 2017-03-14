@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                @if(isset($missingNotes) && count($missingNotes) >= 1)
                    <div class="panel-body">Vous avez {{count($missingNotes)}} visite{{$plurial}} pas encore notée{{$plurial}} <a href="{{ route('visits') }}">Noter</a></div>
                @endif
                <div class="panel-body">
                    @if(Auth::check())
                        You are logged in!
                    @else
                        Please login to access the application
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
