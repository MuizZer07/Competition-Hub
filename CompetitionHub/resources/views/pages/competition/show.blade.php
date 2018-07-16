@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
        <h1 class="card-title">
            {{ $competition->name }}</h1>
            <p class="card-text">
                    Venue: {{ $competition->venue }} <br>
                    Event Date: {{ $competition->event_date}} <br>
                <b> Registration Deadline: {{ $competition->reg_deadline}} </b><br><br>
                    Description: {{ $competition->description}}

            </p>

            {{-- {!!Form::open(['action' => ['CompetitionController@destroy', $competition->id], 
                        'method'=> 'POST', 'class'=> 'pull-right']) !!}

                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete', ['class'=>'btn btn-danger']) }}
            
            {!! Form::close() !!} --}}
        </div>
    </div>
@endsection
