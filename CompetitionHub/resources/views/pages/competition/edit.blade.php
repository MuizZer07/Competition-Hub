@extends('layouts.app')

@section('content')
    <h1>Edit</h1>
    {!! Form::open(['action'=> ['CompetitionController@update', $competition->id], 'method'=>'POST']) !!}
        <div class="form-group">
            {{ Form::label('name','Name')}}
            {{ Form::text('name', $competition->name ,['class'=>'form-control', 'placeholder'=>'Competition Name'])}}
        </div>
        <div class="form-group">
                {{ Form::label('venue','Venue')}}
                {{ Form::text('venue', $competition->venue ,['class'=>'form-control', 'placeholder'=>'Venue'])}}
        </div>
        <div class="form-group">
                {{ Form::label('event_date','Event Date')}}
                {{ Form::date('event_date', $competition->event_date ,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
                {{ Form::label('reg_deadline','Registration Deadline')}}
                {{ Form::date('reg_deadline', $competition->reg_deadline ,['class'=>'form-control'])}}
        </div>
        <div class="form-group">
                {{ Form::label('description','Description')}}
                {{ Form::textarea('description', $competition->description ,['class'=>'form-control', 'placeholder'=>'Write a description'])}}
        </div>
        {{ Form::hidden('_method', 'PUT') }}
        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
    {!! Form::close() !!}
@endsection