@extends('layouts.app')

@section('content')
    <a href="/home" class="btn btn-default"> Go Back </a>
    <h1>Edit your organizer team's information</h1>
    {!! Form::open(['action'=> ['OrganizerTeamController@update', $team->id], 'method'=>'PUT']) !!}
        <div class="form-group">
            {{ Form::label('name','Name')}}
            {{ Form::text('name',  $team->name  ,['class'=>'form-control', 'placeholder'=>'Organizer Team Name'])}}
        </div>
        <div class="form-group">
                {{ Form::label('description','Description')}}
                {{ Form::textarea('description', $team->description ,['class'=>'form-control', 'placeholder'=>'Write a description'])}}
        </div>
        {{ Form::hidden('_METHOD', 'PUT')}}
        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
    {!! Form::close() !!}
    
@endsection