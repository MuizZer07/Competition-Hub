<nav class="navbar navbar-expand-md navbar-light navbar-laravel mainnavbar">
   
      <img src="{{ asset('img/logo.png')}}" alt="Logo" width="5%" height="5%">
      <h3 style="color: white"> {{ config('app.name', 'CompetitionHub')}} </h3>
  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" style="color: white" href="/">Home </a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" style="color: white"href="/competitions">Explore</a>
                  </li>
            <li class="nav-item">
              <a class="nav-link" style="color: white"href="#">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: white" href="#">Services</a>
            </li>
          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              @guest
                  <li class="nav-item">
                      <a class="nav-link" style="color: white" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" style="color: white" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
              @else

                  <li class="nav-item dropdown">
                    <a id="navbarDropdown" style="color: white" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Notificaitons 
                        @if(auth()->user()->unreadNotifications->count() >0)
                            <span class="badge badge-light">
                                    {{ auth()->user()->unreadNotifications->count() }}
                            </span>                            
                    @endif
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a  class="dropdown-item"href=" {{ route('markAsRead') }}"> <span class="badge badge-light"> Mark all as Read</span> </a>
                        @foreach(auth()->user()->unreadNotifications as $notification)
                            @if($notification->type == 'App\Notifications\updatePostNotification')
                                <a class="dropdown-item" href="/update/{{ $notification->data['id'] }}/show" style="background-color: #1c0a7c40"> 
                                    {{ $notification->data['data'] }} </a>
                            @elseif($notification->type == 'App\Notifications\added_to_an_organizer_team')
                                    <a class="dropdown-item" href="/organizerteam/{{ $notification->data['id'] }}" style="background-color: #1c0a7c40"> 
                                        {{ $notification->data['data'] }} </a>  
                                        {{ $notification->data['data'] }} </a>
                            @elseif($notification->type == 'App\Notifications\EventAlert')
                                    <a class="dropdown-item" href="/competitions/{{ $notification->data['id'] }}" style="background-color: #1c0a7c40"> 
                                        {{ $notification->data['data'] }} </a>   
                            @elseif($notification->type == 'App\Notifications\QueryRepliedNotification')
                                    <a class="dropdown-item" href="/query/{{ $notification->data['id'] }}" style="background-color: #1c0a7c40"> 
                                        {{ $notification->data['data'] }} </a> 
                            @elseif($notification->type == 'App\Notifications\newNotification')
                                    <a class="dropdown-item" href="/query/index/{{ $notification->data['id'] }}" style="background-color: #1c0a7c40"> 
                                        {{ $notification->data['data'] }} </a>    
                            @else
                                <a class="dropdown-item" href="#" style="background-color: #1c0a7c40"> 
                                    {{ $notification->data['data'] }} </a>
                            @endif
                        @endforeach
                        @foreach(auth()->user()->readNotifications as $notification)
                            @if($notification->type == 'App\Notifications\updatePostNotification')
                               <a class="dropdown-item" href="/update/{{ $notification->data['id'] }}/show">
                                 {{ $notification->data['data'] }} </a>
                            @elseif($notification->type == 'App\Notifications\added_to_an_organizer_team')
                                  <a class="dropdown-item" href="/organizerteam/{{ $notification->data['id'] }}">
                                     {{ $notification->data['data'] }} </a>   
                            @elseif($notification->type == 'App\Notifications\EventAlert')
                                    <a class="dropdown-item" href="/competitions/{{ $notification->data['id'] }}"> 
                                    {{ $notification->data['data'] }} </a>   
                            @elseif($notification->type == 'App\Notifications\QueryRepliedNotification')
                                    <a class="dropdown-item" href="/query/{{ $notification->data['id'] }}"> 
                                        {{ $notification->data['data'] }} </a>
                            @elseif($notification->type == 'App\Notifications\newNotification')
                                    <a class="dropdown-item" href="/query/index/{{ $notification->data['id'] }}"> 
                                        {{ $notification->data['data'] }} </a>    
                            @else
                              <a class="dropdown-item" href="#"> {{ $notification->data['data'] }} </a>
                            @endif
                        @endforeach 
                    </div>
                </li>

                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" style="color: white" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>
                      
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('home')}}">Dashboard</a>
                      <a class="dropdown-item" href="/{{ Auth::user()->id }}/profile">Profile</a>
                          <a class="dropdown-item" href="/settings">Settings</a>
                           <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a> 

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </div>
                  </li>
              @endguest
              <li class="nav-item">
                <form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
                </form>
              </li>
          </ul>
      </div>
</nav>