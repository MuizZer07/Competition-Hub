@extends('layouts.app')


@section('content')
<div class="content">
    <div class="card">
        <div class="card-body" style="text-align: center">
            <img src="{{ asset('img/logo2.jpg')}}" alt="Logo" width="50%" height="50%">
            <h1 class="card-title">Welcome to CompetitionHub!</h1>
            <p class="card-text">This is the greatest competition hosting platform. Host your competitions and also participate in 
                other competitions around the world. </p>
                <a href="/competitions/create" class="btn btn-default">Host Your Competition</a>
                <a href="/competitions" class="btn btn-default">Explore Competitions</a>
            </div>
    </div>
    <br><br><br><br>
    
</div>
 
 <body> 
       <section id="content-area">
           <div class="container">
               <div class="row">
                   <div id="content-block" class="col-sm-9 col-md-9">
                        <div id="real-content">
                           <div class="row">
                                @if(count($competitions)>0)   
                                    @foreach($competitions as $competition)
                                        <div class="col-md-6 score-card">
                                            <h4>{{ $competition->name }}</h4>
                                            <div class="details">
                                                <p><span>{{ $competition->event_date }}</span>- at {{ $competition->venue }}</p>
                                                
                                                <h4> {{ $competition->description }}</h4>
                                                
                                                <p>
                                                    <strong>
                                                            Registration Deadline: {{ $competition->reg_deadline }} 
                                                        </strong>
                                                </p>
                                                
                                                <div>
                                                <a href="/competitions/{{ $competition->id}}"> View Event Page</a>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach
                                @endif
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </section> 
   </body>
 
@endsection