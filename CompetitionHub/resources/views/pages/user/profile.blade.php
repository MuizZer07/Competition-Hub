@extends('layouts.app')

@section('content')
    <body id="profile-page">
        <section id="content-area">
            <div class="container">
                <div class="row">
                    <div id="content-block" class="col-sm-9 col-md-9">
                        <div id="profile-content">
                           <div id="hero-area">
                               <div id="captions">
                                   <h3> {{ $user->name }}</h3>
                                   <h5> {{ $user->occupation }}</h5>
                               </div>
                           </div>
                            <br>
                           <hr>
                           <div id="education">
                             <div id="header">
                                 <h3></h3>
                             </div>
                             
                               <div class="item">
                                   <div id="uni">
                                   <strong> {{ $user->institution}} </strong>
                                       <p>{{ $user->position}}  <br>
                                        {{ $user->duration}} </p>
                                   </div>
                              </div>
                           </div>        
                        
                           <hr>
                           
                           <div id="accom">
                             <div id="accom-header">
                              <div class="item">
                                 <div class="item-header">
                                     <h4>Languages || <span class="accom-count">2</span></h4>
                                 </div>
                                 
                                  
                                  <div id="list">
                                      <span>English</span>,
                                      <span>Bengali</span>
                                   </div>
                                    </div>
                               <hr>
                               
                               <div class="item">
                                 <div class="item-header">
                                     <h4>Organization || <span class="accom-count">{{count($teams)}}</span></h4>
                                 </div>
                                 
                                  
                                  <div id="list">
                                      @if(count($teams) > 0)
                                        @foreach($teams as $key => $team)
                                            <span>{{ $team->name }}</span>,
                                            @if($key == 10)
                                                @break
                                            @endif
                                        @endforeach
                                      @endif
                                  </div>
                               </div>

                               <hr>
                               <div class="item">
                                    <div class="item-header">
                                        <h4>Participated Competitions || <span class="accom-count">{{count($competitions)}}</span></h4>
                                    </div>
                                    
                                     
                                    <div id="list">
                                            @if(count($competitions) > 0)
                                              @foreach($competitions as $key => $competition)
                                                  <span>{{ $competition->name }}</span>,
                                                  @if($key == 10)
                                                      @break
                                                  @endif
                                              @endforeach
                                            @endif
                                    </div>
                                  </div>
                           </div>
                           
                            <hr>
                            <div id="accom">
                             <div id="accom-header">
                                 <h3>Personal Information</h3>
                             </div>
                             
                               <div class="item">
                                 <div class="item-header info">
                                     <h5>Address:  <span> {{ $user->address }} </span></h5>
                                 </div>
                                 
                                 <div class="item-header info">
                                     <h5>Email:  <span>{{ $user->email }}</span></h5>
                                 </div>

                                 <div class="item-header info">
                                        <h5>Website:  <span>{{ $user->website }}</span></h5>
                                    </div>
                                 
                                 <div class="item-header info">
                                 <h5>Phone: <span>{{ $user->phone_number }}</span></h5>
                                 </div>
                                 
                               </div>
                               
                           </div>

                           <hr>
                           <div id="accom">
                                <div id="accom-header">
                                <h3>About {{ $user->name }} </h3>
                                </div>
                                  <div class="item">
                                    <div class="item-header info">
                                    <h5> <span> "{{ $user->about }}"</span></h5>
                                    </div>
                                    
                                  </div>
                                  
                              </div>
                            
                                    
                        </div>
                        
                        
                    </div>
                    
 
                </div>
            </div>
        </section>    
        
        @endsection