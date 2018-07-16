@extends('layouts.app')


@section('content')
                
    @if(count($competitions)>0)   
        @foreach($competitions as $competition)
            <div class="card">
                <div class="card-body">
                <a style="text-decoration: none;" href="/competitions/{{$competition->id}}"> <h1 class="card-title">{{ $competition->name }}</h1> </a>
                    <p class="card-text">
                         at {{ $competition->venue }} 
                         on {{ $competition->event_date}}
                    </p>
                </div>
            </div>
        @endforeach
    @endif



 
@endsection