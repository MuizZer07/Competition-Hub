@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
        <h1 class="card-title">
            All Participants information:</h1>
            @if(count($history)>0)
                <p class="card-text">
                @foreach($history as $history)
                    {{ $history->participant_id }}<br>
                @endforeach
            @endif
            </p>
            <hr>
        </div>
    </div>
@endsection
