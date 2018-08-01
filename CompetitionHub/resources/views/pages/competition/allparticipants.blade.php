@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
        <h1 class="card-title">
            All Participants information:</h1>
            @if(count($users)>0)
                <p class="card-text">
                
                    <table class="table table-striped">
                            <tr>
                                <th>Participant Name</th>
                                <th>Participant Email</th>
                                <th></th>
                            </tr>
                            @foreach($users as $user)
                            <tr>
                                <td> {{ $user->name }}</td>
                                <td> {{ $user->email }}</td>
                            </tr>
                            @endforeach
                        </table>
            @endif
            </p>
            <hr>
        </div>
    </div>
@endsection
