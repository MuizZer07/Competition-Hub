
@extends('layouts.admins')

@section('content')


<h1>Competition Dashboard</h1>

<div class="card">
        <div class="card-body">
        <h3 class="card-title">
            All Competition Information:</h3>
            @if(count($competitions)>0)
                <p class="card-text">
                    <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Competition Name</th>
                                <th> Venue </th>
                                <th>Event Date</th>
                                <th>Registration Deadline</th>
                                <th></th>
                            </tr>
                            @foreach($competitions as $competition)
                            <tr>
                                <td> {{ $competition->id }}</td>
                                <td> <a href="/competitions/{{ $competition->id }}">{{ $competition->name }} </a></td>
                                <td> {{ $competition->venue }}</td>
                                <td> {{ $competition->event_date }}</td>
                                <td> {{ $competition->reg_deadline }}</td>
                            </tr>
                            @endforeach
                        </table>
            @endif
            </p>
            <hr>
        </div>
    </div>
@endsection


