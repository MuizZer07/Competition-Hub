@extends('layouts.app')

@section('content')
<div class="container">    
    @if(auth()->user()->token != null)
        <div class="alert alert-danger" role="alert">
            Please Verify your Email Account. 
        </div>
    @endif

    @if($error != null)
        <div class="alert alert-danger" role="alert">
            {{ $error }}<hr>
            <a href="/{{auth()->user()->id}}/profile_edit" class="btn btn-danger"> Edit Your Profile </a>
            <a href="/{{auth()->user()->id}}/profile" class="btn btn-danger"> See Your Profile </a>
        </div>
    @endif
        
    <div class="row justify-content">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    See Your Orgnizer teams <br>
                    <a href="/organizerteam/create" class="btn btn-info pull-right">Create new Team</a><br><br>

                    @if(count($teams)>0)
                    <table class=" table-striped">
                        <tr style="text-align: center">
                            <th>Team Name</th>
                            <th>Description</th>
                            <th>Edit</th>
                            <th colspan="2">Members</th>
                        </tr>
                        @foreach($teams as $team)
                        <tr>
                            <td> {{ $team->name }}</td>
                            <td> {{ $team->description }}</td>
                            <td><a href="organizerteam/{{$team->id}}/edit" class="btn btn-default">Edit</a></td>
                            <td><a href="organizerteam/{{$team->id}}" class="btn btn-default">View Members</a></td>
                            <td><a href="/organizers/create/{{$team->id}}" class="btn btn-default">Add Members</a></td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                    @endif
                </div>    
        </div>
    </div>

    <div class="col-md-6">
            <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        You are partipicating: Upcoming Competitions <br>
                        <a href="/competitions" class="btn btn-info">explore More!</a><br><br>
    
                        @if(count($competitions)>0)
                        <table class="table table-striped">
                            <tr>
                                <th>Competition Name</th>
                                <th>Date</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($competitions as $competition)
                            <tr>
                                <td> {{ $competition->name }}</td>
                                <td> {{ $competition->event_date }}</td>
                                <td> <a href="/update/{{ $competition->id }}/show" class="btn btn-info">See updates</a> </td>
                                <td> <a href="/history/delete/{{auth()->user()->id}}/{{ $competition->id }}" class="btn btn-danger">Cancel Paricipation</a> </td>
                            </tr>
                            @endforeach
                        </table>
                        @else
    
                        @endif
                    </div>
                </div>
        </div>
</div><br>
<div class="row justify-content">
        <div class="col-md-12">
            <div class="card">
                    <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            Your organizing Events <br>
                            <a href="/competitions/create" class="btn btn-info pull-right">Host New Competition</a><br><br>
        
                            @if(count($comp)>0)
                            <table class="table table-striped">
                                <tr>
                                    <th>Competition Name</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                               @foreach($comp as $c)    
                                <tr>
                                    <td> <a href="/competitions/{{ $c->id }}" >{{ $c->name }} </a></td>
                                
                                    <td>
                                        <a href="/competitions/{{ $c->id }}/edit" class="btn btn-info">
                                            Edit
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/query/index/{{ $c->id }}" class="btn btn-info">
                                            Check Queries
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/update/{{ $c->id }}/create" class="btn btn-info">
                                            Post new Update
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/competitions/{{ $c->id }}/delete" class="btn btn-danger">
                                            Delete
                                        </a>
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
