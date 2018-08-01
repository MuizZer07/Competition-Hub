<nav class="navbar navbar-expand-md navbar-light navbar-laravel mainnavbar">
   
      <img src="{{ asset('img/logo.png')}}" alt="Logo" width="10%" height="10%">
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
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>
                      
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('home')}}">Dashboard</a>
                          <a class="dropdown-item" href="#">Profile</a>
                          <a class="dropdown-item" href="#">Settings</a>
                          <!-- <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a> -->
                          <a class="dropdown-item" href="{{ route('chlogout')}}">Logout</a>

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