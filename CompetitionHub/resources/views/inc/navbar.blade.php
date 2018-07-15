<nav class="navbar navbar-expand-lg navbar-light mainnavbar">
        <a class="navbar-brand" href="/">
            <div class="icon">
                    <img src="img/logo.png" alt="Logo" width="20%" height="20%">
                    {{ config('app.name', 'CompetitionHub')}}
            </div>
            
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse Menu" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" style="color: white" href="/">Home </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" style="color: white"href="#">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: white" href="#">Services</a>
            </li>           
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>