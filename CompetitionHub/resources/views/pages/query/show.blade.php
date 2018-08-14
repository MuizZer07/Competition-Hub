@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
            <div class="card-body">
                    <p>
                        @if($query)
                        <h3> Asked Query: </h3> {{ $query->query }}
                        @else

                        @endif
                    </p>

                    <p>
                        @if($query)
                        <h3> Answer: </h3> {{ $query->reply }}
                        @else
    
                        @endif
                        
                    </p>
                </div>
            </div>
    </div>
@endsection