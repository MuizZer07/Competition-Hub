@extends('layouts.app')


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5 col-md-6 card" style="padding: 10px">
                    <h3 class="card-title text-center"> Top Competitions </h3><hr>
                    @if(count($competitions)>0)   
                        @foreach($competitions as $key => $competition)
                            <div class="card">
                                <div class="card-body">
                                <a style="text-decoration: none;" href="/competitions/{{$competition->id}}"> <h3 class="card-title">{{ $competition->name }}</h3> </a>
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
                            @if(++$key == 2)
                                @break
                            @endif
                        @endforeach
                        <a class="btn btn-default" href="/competitions/top_competitons"> See all </a>
                    @endif
            </div>
            <div class="col-sm-5 col-md-6 card" style="padding: 10px">
                    <h3 class="card-title text-center"> Top Catagories & Competitions </h3><hr>
                        @foreach($catagories as $key => $catagory)
                        <div class="card">
                                <div class="card-body">
                                    <h2 class="card-title">{{ $catagory->name }} </h2><hr>
                                    @foreach($competitions as $competition)
                                        @php ($counter = 0)
                                        @if($catagory->id == $competition->catagory_id)
                                        <a style="text-decoration: none;" href="/competitions/{{$competition->id}}"> 
                                            <h3 class="card-title">{{ $competition->name }}</h3> </a>
                                            at {{ $competition->venue }} 
                                            on {{ $competition->event_date }}
                                        @endif
                                        @if(++$counter == 2)
                                            @break
                                        @endif
                                    @endforeach
                                </div>
                                @if(++$key == 2)
                                     @break
                                @endif
                                @endforeach
                        </div>
                        <a class="btn btn-default" href="/competitions/top_competitons_by_catagory"> See all </a>
            </div>
        </div>
        <br>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-5 col-md-6 card" style="padding: 10px">
                    <h3 class="card-title text-center"> Registration Deadlines </h3><hr>
                    @foreach($competitions as $key => $competition)
                        @if($competition->reg_deadline <= $date) 
                        <div class="card">
                            <div class="card-body">
                            <a style="text-decoration: none;" href="/competitions/{{$competition->id}}"> 
                                <h3 class="card-title">{{ $competition->name }}</h3> </a>
                                <p class="card-text"> 
                                            at {{ $competition->venue }} 
                                            on {{ $competition->event_date }}<br>
                                            <strong> Registration Deadline {{ $competition->event_date }} </strong>
                                </p>
                            </div>
                        </div>
                        @endif
                        @if(++$key == 2)
                                @break
                        @endif
                    @endforeach
                    <a class="btn btn-default" href="#"> See all </a>
               
            </div>
            <div class="col-sm-5 col-md-6 card" style="padding: 10px">
                    <h3 class="card-title text-center"> Universities </h3><hr>
                    <h4 class="card-title text-center"> North South University</h4>
                    @foreach($competitions as $key => $competition)
                        @if($competition->venue == 'North South University') 
                            <div class="card">
                                <div class="card-body">
                                <a style="text-decoration: none;" href="/competitions/{{$competition->id}}"> <h3 class="card-title">{{ $competition->name }}</h3> </a>
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
                        @endif
                        @if(++$key == 2)
                                @break
                        @endif
                    @endforeach
                    <a class="btn btn-default" href="#"> See all </a>
            </div>
        </div>
        <br>
    </div>
    </div>
 
@endsection