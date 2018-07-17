@extends('layouts.app')

@section('content')
    <a href="/competitions" class="btn btn-default"> Go Back </a>
    <h1>Create your organizer team</h1>
    {!! Form::open(['action'=> 'OrganizerTeamController@store', 'method'=>'POST']) !!}
        <div class="form-group">
            {{ Form::label('name','Name')}}
            {{ Form::text('name', '',['class'=>'form-control', 'placeholder'=>'Organizer Team Name'])}}
        </div>
        <div class="form-group">
                {{ Form::label('description','Description')}}
                {{ Form::textarea('description', '',['class'=>'form-control', 'placeholder'=>'Write a description'])}}
        </div>
        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
    {!! Form::close() !!}
    
@endsection