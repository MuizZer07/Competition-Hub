@extends('layouts.app')

@section('content')
                
<h3 class="card-title text-center"> Top Catagories & Competitions </h3><hr>
    @foreach($catagories as $catagory)
    <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ $catagory->name }} </h2><hr>
                @foreach($competitions as $competition)
                    @if($catagory->id == $competition->catagory_id)
                        <a style="text-decoration: none;" href="/competitions/{{$competition->id}}"> <h3 class="card-title">{{ $competition->name }}</h3> </a>
                            at {{ $competition->venue }} 
                            on {{ $competition->event_date }}
                    @endif
                @endforeach
            </div>
            @endforeach
    </div>
@endsection