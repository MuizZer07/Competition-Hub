@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header"><h1>Add members</h1></div>
   
    <div class="card-body">
    <h1>Add Team Members</h1>
    {!! Form::open(['action'=> ['OrganizersController@store', $id], 'method'=>'GET']) !!}
        <div class="form-group">
            {{ Form::label('name','Add')}}
            {!! Form::select('users[]', $users->pluck('name')->all(), ['class' => 'form-control'],[
                'multiple' => 'multiple', 'id'=>'users'
            ]) !!}
        </div>
        {{ Form::hidden('usersss', $users) }}
        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
    {!! Form::close() !!}
    </div>
</div>
</div>
@endsection