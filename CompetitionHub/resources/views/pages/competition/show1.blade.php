@extends('layouts.app')

@section('content')
    
    <body id="home-page">      
        <section id="content-area">
            <div class="container">
                <div class="row">
                   
                   <div id="sidebar" class="col-sm-3 col-md-3">
                
                        <div id="home-sidebar">
                            <div id="profile-image">
                                <img class="img-responsive" src="assets/images/profile-image.jpg" alt="">
                            </div>
                            
                            <div id="event-options">
                                <a href="/organizerteam/{{ $competition->organizer_teams_id }}"><button class="btn btn-info btn-block"> Organizers </button></a>
                            </div>
                            
                            <div id="other-options" style="padding:10px">
                                <ul>
                                    <li><a href="">Discussion</a></li>
                                    <li> <a href="">About</a></li>
                                    <li><a href="">Photo</a></li>
                                    <li> <a href="">Announcements</a></li>
                                </ul>
                            </div>
                        </div>
                        
                   </div>
                    
                    <div id="content-block" class="col-sm-9 col-md-9">
                       
                        
                            <h1 class="card-title">
                                    {{ $competition->name }}</h1>
                                    <p class="card-text">
                                            Catagory: {{ $catagory->name }} <br>
                                            Venue: {{ $competition->venue }} <br>
                                            Event Date: {{ $competition->event_date }} <br>
                                        <b> Registration Deadline: {{ $competition->reg_deadline}} </b><br><br> 
                                        Description: {{ $competition->description}}
                                        <div id="map">     <!-- google map added -->
                                        </div>
                                    </p>
                                    <hr>

                        
                        <div id="home-content">
                            <div class="hidden-xs" id="banner">
                                <form id="upload" method="get">
                                   <div class="form-group">
                                   </div>
                                </form>
                            </div>
                            
                            <div id="event">
                               <div class="event-buttons">
                                    @guest
                                        <a href="{{ route('login') }}" class="btn btn-info"> Login to Participate </a>
                                    @else
                                        @if(count($history)>0)
                                                <a href="#" class="btn btn-info btn-disabled"> You are participating! </a>
                                        @else
                                            @if($flag)
                                                <a href="#" class="btn btn-info btn-disabled btn-danger"> Registration Deadline is Over!!</a>
                                            @else
                                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                                                Participate
                                                </button>
                                                
                                                <div class="modal" id="myModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">{{ $competition->name }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                
                                                    <div class="modal-body">
                                                        <b>You are going to be a participant of this competition. Confirm?</b><br>                                
                                                    </div>
                                                
                                                    <div class="modal-footer">
                                                        {!! Form::open(['action'=> ['ParticipationHistoryController@store', $competition], 'method'=>'POST']) !!}
                                                        {{ Form::hidden('competition_id', $competition->id) }}  
                                                        {{ Form::submit('Yes', ['class'=>'btn btn-info']) }}
                                                        {!! Form::close() !!}
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                
                                                    </div>
                                                </div>
                                                </div>
                                            @endif
                                        @endif

                                    @endguest
                                    <a class="btn btn-info" href=""> Report </a>
                                    <a class="btn btn-info" href=""> Host New Competition </a>
                               </div>
                               <hr>
                            </div>
                            
                            
                            <div id="post-area">
                                <div id="left" class="col-sm-8 col-md-9">

                                    {!! Form::open(['action'=> ['QueryController@store', $competition->id], 'method'=>'POST']) !!}
                                    <div class="form-group">
                                        {{ Form::textarea('query', '',['class'=>'form-control', 'placeholder'=>'Ask A Question to the Organizers'])}}
                                    </div>
                                    <button style="display:inline-block" type="submit" class="btn btn-info">Submit</button>              
                                    {!! Form::close() !!}
                                    
                                    <hr>
                                    <div id="timeline">
                                        <h4> Updates </h4>
                                    </div>
                                </div>
                                
                                <div id="right" class="col-sm-6 col-md-5">
                                    @if(count($updates)> 0)
                                         @foreach($updates as $update)
                                         <ul>
                                                <li> {{ $update->post }}<br> <small>
                                                     updated on {{ $update->created_at }} </small> </li>
                                         </ul>
                                        @endforeach
                                    @else
                                        No Recent Updates
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                </div>
            </div>
        </section> 
    </body>
    @endsection