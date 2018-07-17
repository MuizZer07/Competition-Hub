@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    See Your Orgnizer teams <br>
                    <a href="/organizerteam/create" class="btn btn-info pull-right">Create new Team</a><br><br>

                    @if(count($teams)>0)
                    <table class="table table-striped">
                        <tr>
                            <th>Team Name</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($teams as $team)
                        <tr>
                            <td> {{ $team->name }}</td>
                            <td> <a href="/organizerteam/edit" class="btn btn-default">Edit</a></td>
                            <td> 
                                <a href="/organizers/create" class="btn btn-default">Add Members</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @else

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
