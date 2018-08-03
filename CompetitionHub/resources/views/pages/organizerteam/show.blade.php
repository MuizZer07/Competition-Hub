@extends('layouts.app')

@section('content')

    <div class="card">
            <div class="card-header">Dashboard</div>

            <div class="card-body">
                <a href="/home" class="btn btn-default"> Go Back </a>
                <h1> {{ $team->name }} Members: </h1>
                <small> {{ $team->description }} </small>
                <hr>
                <table class="table table-striped">
                        <tr>
                            <th> Name </th>
                        </tr>
                        @foreach($members as $member)
                        <tr>
                            <td> {{ $member->name }} </td>
                        </tr>
                        @endforeach
                    </table>


        
            </div>
        </div>
   
@endsection