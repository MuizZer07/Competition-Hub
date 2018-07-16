@extends('layouts.app')


@section('content')
<div class="content">
    <div class="card">
        <div class="card-body" style="text-align: center">
            <h1 class="card-title">Welcome to CompetitionHub!</h1>
            <p class="card-text">This is the greatest competition hosting platform. Host your competitions and also participate in 
                other competitions around the world. </p>
                <a href="/competitions/create" class="btn btn-default">Host Your Competition</a>
                <a href="/competitions" class="btn btn-default">Explore Competitions</a>
            </div>
    </div>
    <br><br><br><br><br><br><br><br>
    
</div>


 
@endsection