@extends('layouts.app')

@section('content')
    <a href="/home" class="btn btn-default"> Go Back </a>
    {!! Form::open(['action'=> ['UpdatesController@store', $competition_id ], 'method'=>'POST']) !!}
        <div class="form-group">
                {{ Form::label('post','Update Post')}}
                {{ Form::textarea('post', '',['class'=>'form-control', 'placeholder'=>'Update about your event'])}}
        </div>
        {{ Form::hidden('competition_id', $competition_id) }}
        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
    {!! Form::close() !!}
    
@endsection