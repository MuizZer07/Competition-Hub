@extends('layouts.app')

@section('content')
    <a href="/competitions" class="btn btn-default"> Go Back </a>
    <h1>Add Team Members</h1>
    {!! Form::open(['action'=> 'OrganizersController@store', 'method'=>'POST']) !!}
        <div class="form-group">
            {{ Form::label('name','Add')}}
            {!! Form::select('users', $users, ['class' => 'form-control'],[
                'multiple' => true, 'id'=>'rolesLista'
            ]) !!}
        </div>
        
        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
    {!! Form::close() !!}
    
@endsection