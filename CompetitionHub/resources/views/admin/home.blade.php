
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

        
@endsection