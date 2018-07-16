@extends('layouts.app')

@section('content')
    <a href="/competitions" class="btn btn-default"> Go Back </a>
    <h1>Create a Competition</h1>
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
        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
    {!! Form::close() !!}
    
@endsection