@extends('layouts.app')

@section('content')

    <div class="card">
            <div class="card-header">Organizers:</div>

            <div class="card-body">
                <a href="/home" class="btn btn-default"> Go Back </a>
                <h1> Team Name: {{ $team->name }} </h1>
                <small> {{ $team->description }} </small>
                <hr>
                <h3> Members: </h3>
                <table class="table table-striped">
                        <tr>
                            <th> Name </th>
                            <th></th>
                        </tr>
                        @foreach($members as $member)
                        <tr>
                            <td> <a href="/{{ $member->id }}/profile"> {{ $member->name }} </a></td>
                            @if(auth()->user()->id == $team->creator_id)
                                 @if(auth()->user()->id != $member->id)
                                     <td> <a href="/organizers/delete/{{ $member->id }}/{{ $team->id }}" class="btn btn-danger"> Remove Member </a></td>   
                                @endif
                            @endif        
                        </tr>
                        @endforeach
                    </table>


        
            </div>
        </div>
   
@endsection