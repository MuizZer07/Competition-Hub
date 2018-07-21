@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
        <h1 class="card-title">
            {{ $competition->name }}</h1>
            <p class="card-text">
                    Catagory: {{ $catagory->name }} <br>
                    Venue: {{ $competition->venue }} <br>
                    Event Date: {{ $competition->event_date }} <br>
                <b> Registration Deadline: {{ $competition->reg_deadline}} </b><br><br>
                    Description: {{ $competition->description}}
            </p>
            <hr>

                  
                  @guest
                    <a href="{{ route('login') }}" class="btn btn-default"> Login to Participate </a>
                  @else
                      @if(count($history)>0)
                          <a href="#" class="btn btn-default btn-disabled"> You are participating! </a>
                      @else
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                          Participate
                        </button>
                        
                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                          <div class="modal-dialog">
                            <div class="modal-content">
                        
                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">{{ $competition->name }}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                        
                              <!-- Modal body -->
                              <div class="modal-body">
                                  <b>You are going to be a participant of this competition. Confirm?</b><br>                                
                              </div>
                        
                              <!-- Modal footer -->
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

                  @endguest
                  
                  
            
            {{-- {!!Form::open(['action' => ['CompetitionController@destroy', $competition->id], 
                        'method'=> 'POST', 'class'=> 'pull-right']) !!}

                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Delete', ['class'=>'btn btn-danger']) }}
            
            {!! Form::close() !!} --}}
        </div>
    </div>
@endsection
