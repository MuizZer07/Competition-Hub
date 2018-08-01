@extends('layouts.app')

@section('content')
    
    <body id="home-page">
       
        
        
        <section id="nav-area">
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="index.html">Fat Sports</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    
                    <li class="active"><a href="">Home</a></li>   
                             
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Live scores</a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Home</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Desktop scorecard</a></li>
                      </ul>
                    </li>
                    
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Series</a>
                      <ul class="dropdown-menu">
                        <li><a href="#">South Africa v Bangladesh</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">India v Australia</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">NCL</a></li>
                      </ul>
                    </li>
                    
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Teams</a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Home</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">West Indies</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Bangladesh</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Srilanka</a></li>
                      </ul>
                    </li>
                    
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Features</a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Home</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Writers</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">The Cricket Monthly</a></li>
                      </ul>
                    </li>
                    
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Videos</a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Home</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">News and Analysis</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Interviews</a></li>
                      </ul>
                    </li>
                    
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Stats</a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Home</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Insights</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Rankings</a></li>
                      </ul>
                    </li>
                  </ul>
                  
                  
                  
                  <ul class="nav navbar-nav navbar-right">
                   
                   
                   
                   <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-search"></i></a>
                      <ul class="dropdown-menu">
                        <li style="overflow: hidden;">
                            <form class="navbar-form" method="get">
                                <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Search Sports, Teams or Players...">
                                </div>
                            </form>
                        </li>
                      </ul>
                    </li>
                   
                   <li><a href="profile.html">Profile</a></li>
                   
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Edition BD <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                            <p>SELECT EDITION</p>
                            <li role="separator" class="divider"></li>
    
                            <li><a href="#">Africa</a></li>
                            <li><a href="#">Bangladesh</a></li>
                            <li><a href="#">Pakistan</a></li>
                      
<!--                            <li role="separator" class="divider"></li>-->
                      
                            <li><a href="#">Australia</a></li>
                            <li><a href="#">Global</a></li>
                            <li><a href="#">United States</a></li>
                    
                        
                      </ul>
                    </li>
                    
                    <li id="wide-dropdown" class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <i class="fa fa-bell notification-active"></i>  <span id="new-notification"> (2)</span></a>
                      <ul class="dropdown-menu" id="notification">
                            <li>
                                <a href="#">
                                    <img src="assets/images/wisden.png" alt=""> Some Notification
                                </a> 
                            </li>
                            
                            <li role="separator" class="divider"></li>
                            
                            <li>
                                <a href="#">
                                    <img src="assets/images/espn-logo-cric.png" alt=""> Another Notification
                                </a> 
                            </li>
                      </ul>
                    </li>
                    
                    
                      
                      <li>
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-envelope message-active"></i> <span id="new-notification"> (2)</span>
                          </a>
                          
                          <ul class="dropdown-menu" id="message">
                                <li>
                                    <a href="#">
                                        <img class="img-circle" src="assets/images/circle-image-01.jpg" alt=""> 
                                        <span><strong>Nasim Ahmed</strong> <br> you're fired!</span>
                                    </a> 
                                </li>

                                <li role="separator" class="divider"></li>

                                <li>
                                    <a href="#">
                                        <img class="img-circle" src="assets/images/circle-image-02.jpg" alt=""> 
                                        <span><strong>Shahriar Haque</strong> <br> wtf! man, where is my money?</span>
                                    </a> 
                                </li>
                          </ul>
                      </li>
                      
                    <li><a href="#">Log in</a></li>
                    
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
        </section> <!--   end nav area     -->
        
        
        
        <section id="content-area">
            <div class="container">
                <div class="row">
                   
                   <div id="sidebar" class="col-sm-3 col-md-3">
                
                        <div id="home-sidebar">
                            <div id="profile-image">
                                <img class="img-responsive" src="assets/images/profile-image.jpg" alt="">
                            </div>
                            
                            <div id="event-options">
                                <a href=""><button class="btn btn-primary btn-block">Event Creator</button></a>
                            </div>
                            
                            <div id="other-options">
                                <a href="">Discussion</a>
                                <a href="">About</a>
                                <a href="">Photo</a>
                                <a href="">Announcements</a>
                            </div>
                        </div>
                        
                   </div>
                    
                    <div id="content-block" class="col-sm-9 col-md-9">
                       
                        
                        <div id="home-content">
                            <div class="hidden-xs" id="banner">
                                <form id="upload" method="get">
                                   <div class="form-group">
                                       <label for="file-upload" class="custom-file-upload">
                                            <i class="fa fa-camera"></i> <span>Update Banner</span>
                                       </label>
                                        <input type="file" id="file-upload" name="" id="">
                                   </div>
                                </form>
                                <img class="img-responsive" src="assets/images/banner.jpg" alt="">
                               
                            </div>
                            
                            <div id="event">
                               <div class="event-buttons">
                                    <a class="btn btn-primary" href="">Join Event</a>
                                    <a class="btn btn-primary" href="">Report Event</a>
                                    <a class="btn btn-primary" href="">Create Event</a>
                               </div>
                               
                               <div class="event-buttons pull-right">
                                    <a class="btn btn-primary" href="">Message</a>
                               </div>
                            </div>
                            
                            
                            <div id="post-area">
                                <div id="left" class="col-sm-8 col-md-9">
                                    <form method="post" action="">
                                        <div class="form-group">
                                            <textarea class="form-control" rows="4">What's on your mind...</textarea>
                                            
                                            <button style="display:inline-block" type="submit" class="btn btn-primary">Post</button>
                                            
                                           
                                               <label for="file-upload" class="custom-file-upload">
                                                    <i class="fa fa-camera"></i> <span>photo/video</span>
                                               </label>
                                               <input style="display: none;" type="file" id="file-upload" name="" id="">
                                           
                                        </div>
                                    </form>
                                    <hr>
                                    <div id="timeline">
                                        <h4>Timeline Content Goes Below</h4>
                                    </div>
                                </div>
                                
                                <div id="right" class="col-sm-4 col-md-3">
                                    <h4>Events</h4>
                                    <div id="event-list">
                                       <div class="item">
                                            <a href=""><img class="img-responsive" src="assets/images/event.jpg" alt=""></a>
                                            <div id="links">
                                                <a href="">Invite People</a>   
                                                <a href="">Members</a>   
                                                <a href="">Share</a> 
                                            </div>   
                                       </div>
                                       <hr>
                                       <div class="item">
                                            <a href=""><img class="img-responsive" src="assets/images/event.jpg" alt=""></a>
                                            <div id="links">
                                                <a href="">Invite People</a>   
                                                <a href="">Members</a>   
                                                <a href="">Share</a> 
                                            </div>   
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                </div>
            </div>
        </section> <!--   end content area     -->
        
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer-nav">
                            <a href="">sitemap</a>
                            <a href="">feedback</a>
                            <a href="">rss</a>
                            <a href="">about us</a>
                            <a href="">careers</a>
                            <a href="">privacy policy</a>
                            <a href="">terms of use</a>
                            
                            
                            <a href="">interest based ads</a>
                            <a href="">privacy rights</a>
                            <a href="">children privacy policy</a>
                        </div>
                        
<!--                        <img src="assets/images/footer-brand.PNG" alt="" class="img-responsive">-->
                        <br>
                        
                        
                        <p id="copy" class="">
                            &copy; FAT SPORTS MEDIA LTD.
                        </p>
                    </div>
                </div>
            </div>
        </footer> <!--   end footer area     -->
       
    </body>
    @endsection