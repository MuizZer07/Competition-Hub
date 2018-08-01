@extends('layouts.app')

@section('content')

    <div class="card">
            <div class="card-header">Recent Updates</div>

            <div class="card-body">
                <a href="/home" class="btn btn-default"> Go Back </a>               

                <table class="table table-striped">
                        
                        @if(count($updates) == 0)
                             No recent  updates
                        @else
                            @foreach($updates as $update)
                            <ul>
                                <li> {{ $update->post }} <br> <small> updated on {{ $update->created_at }} </small> </li>
                            </ul>
                            @endforeach
                        @endif
                    </table>


        
            </div>
        </div>
   
@endsection