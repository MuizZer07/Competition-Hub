@extends('layouts.app')


@section('content')
                
    @if(count($competitions)>0)   
        @foreach($competitions as $competition)
            <div class="card">
                <div class="card-body">
                <a style="text-decoration: none;" href="/competitions/{{$competition->id}}"> <h1 class="card-title">{{ $competition->name }}</h1> </a>
                    <p class="card-text"> 
                        @foreach($catagories as $catagory)
                            @if($catagory->id == $competition->catagory_id)
                                <b>Catagory: {{ $catagory->name }} </b><br>
                                at {{ $competition->venue }} 
                                on {{ $competition->event_date }}
                            @endif
                        @endforeach
                    </p>
                </div>
            </div>
        @endforeach
    @endif



 
@endsection