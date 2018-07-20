@extends('layouts.app')

@section('content')

<div class="card">
 <div class="card-header"><h1>Create a Competition</h1></div>

 <div class="card-body">
    <a href="/competitions" class="btn btn-info"> Go Back </a>
    
    {!! Form::open(['action'=> 'CompetitionController@store', 'method'=>'POST']) !!}
        <div class="form-group">
            {{ Form::label('name','Name')}}
            {{ Form::text('name', '',['class'=>'form-control', 'placeholder'=>'Competition Name'])}}
        </div>
        <div class="form-group">
                {{ Form::label('venue','Venue')}}
                {{ Form::text('venue', '',['class'=>'form-control', 'placeholder'=>'Venue'])}}
        </div>
        <div class="form-group">
                {{ Form::label('event_date','Event Date')}}
                {{ Form::date('event_date', '',['class'=>'form-control'])}}
        </div>
        <div class="form-group">
                {{ Form::label('reg_deadline','Registration Deadline')}}
                {{ Form::date('reg_deadline', '',['class'=>'form-control'])}}
        </div>
        <div class="form-group">
                {{ Form::label('description','Description')}}
                {{ Form::textarea('description', '',['class'=>'form-control', 'placeholder'=>'Write a description'])}}
        </div>
        <div class="form-group">
                {{ Form::label('organizer_team','Orgnizer Team')}}
                {!! Form::select('Select Your team:',  $teams->pluck('name')->all(), ['class' => 'form-control'],
                ['id'=>'users' ]) !!}
            </div>
        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
    {!! Form::close() !!}
 </div>
</div>
</div>
@endsection