
@extends('layouts.admins')

@section('content')


<h1>Users Dashboard</h1>

<div class="card">
        <div class="card-body">
        <h1 class="card-title">
            All Users information:</h1>
            @if(count($users)>0)
                <p class="card-text">
                
                    <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Users Name</th>
                                <th></th>
                            </tr>
                            @foreach($users as $user)
                            <tr>
                                <td> {{ $user->id }}</td>
                                <td> {{ $user->name }}</td>
                            </tr>
                            @endforeach
                        </table>
            @endif
            </p>
            <hr>
        </div>
    </div>
@endsection


