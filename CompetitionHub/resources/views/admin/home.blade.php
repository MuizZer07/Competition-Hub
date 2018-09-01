
@extends('layouts.admins')

@section('content')


<h1>Admin Dashboard</h1>

<section class="row text-center">
    <div class="col-6 col-sm-3  card" style="border-radius: 25%;">
        <h1>{{ count($users)}}</h1>
        Total Users
    </div>
    <div class="col-6 col-sm-3  card" style="border-radius: 25%">
        <h1>{{ count($competitions)}}</h1>
        New Competitions
    </div>
    <div class="col-6 col-sm-3  card" style="border-radius: 25%">
        <h1>{{ count($history)}} </h1>
        Total Participants
    </div>
    <div class="col-6 col-sm-3  card" style="border-radius: 25%">
        <h1>{{ count($organizers)}}</h1>
        Total Organizers
    </div>
</section>

<div class="card">
    <div class="card-header"><h1>Create Catagory</h1></div>

    <div class="card-body">

    {!! Form::open(['action'=> 'CatagoryController@store', 'method'=>'POST']) !!}
        <div class="form-group">
            {{ Form::label('name','Name')}}
            {{ Form::text('name', '',['class'=>'form-control', 'placeholder'=>'Catagory Name'])}}
        </div>

        <div class="form-group">
                {{ Form::label('description','Description')}}
                {{ Form::textarea('description', '',['class'=>'form-control', 'placeholder'=>'Write a description'])}}
        </div>
        
        {{ Form::submit('Submit', ['class'=>'btn btn-primary']) }}
    {!! Form::close() !!}
    </div>
</div>





        
@endsection