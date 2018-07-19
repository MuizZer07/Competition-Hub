@extends('layouts.app')

@section('content')
    <a href="/home" class="btn btn-default"> Go Back </a>
    <h1>Add Team Members</h1>
    {!! Form::open(['action'=> ['OrganizersController@store', $id], 'method'=>'GET']) !!}
        <div class="form-group">
            {{ Form::label('name','Add')}}
            {!! Form::select('users[]', $users->pluck('name')->all(), ['class' => 'form-control'],[
                'multiple' => 'multiple', 'id'=>'users'
            ]) !!}
        </div>
        
        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
    {!! Form::close() !!}
    
@endsection