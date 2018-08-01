@extends('layouts.app')

@section('content')
    <body id="profile-page">
       
        
        
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
                    
                    <li><a href="home.html">Home</a></li>   
                             
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
                   
                   <li class="active"><a href="profile.html">Profile</a></li>
                   
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
                   
                    
                    <div id="content-block" class="col-sm-9 col-md-9">
                       
                        
                        <div id="profile-content">
                            
                            
                           <div id="hero-area">
                               <img class="img-thumbnail" src="assets/images/profile-image.jpg" alt="">
                               <div id="captions">
                                   <h3>Nasim Ahmed</h3>
                                   <h5>Admin, Fatties inc.</h5>
                               </div>
                           </div>
                            
                           <div id="education">
                             <div id="header">
                                 <h3>Education</h3>
<!--                                 <a class="pull-right" href=""><i class="fa fa-plus"></i></a>    -->
                             </div>
                             
                              <div class="item">
                                  <img src="assets/images/edu.PNG" alt="">
                                  
                                  <div id="uni">
                                       <strong>Engineeing College</strong>
                                       <p>HSC</p>
                                       <p>2008-2010</p>
                                   </div>
                                   
<!--                                   <div class="pull-right" id="edit"><a href=""><i class="fa fa-pencil"></i></a></div>-->
                               </div>
                               <hr>
                               <div class="item">
                                   <img src="assets/images/edu.PNG" alt=""> 
                                        
                                   <div id="uni">
                                       <strong>BRAC University</strong>
                                       <p>Bachelor's Degree, Computer Science</p>
                                       <p>2010-2016</p>
                                   </div>
                                   
<!--                                   <div class="pull-right" id="edit"><a href=""><i class="fa fa-pencil"></i></a></div>                                 -->
                               </div>
                           </div>        
                        
                           
                           
                           <div id="accom">
                             <div id="accom-header">
                                 <h3>Accomplishments</h3>
<!--                                 <a class="pull-right" href=""><i class="fa fa-plus"></i></a>    -->
                             </div>
                             
                              <div class="item">
                                 <div class="item-header">
                                     <h4>Languages</h4>
<!--                                     <a class="pull-right" href=""><i class="fa fa-plus"></i></a>-->
                                 </div>
                                 
                                  <span class="accom-count">2</span>
                                  <div id="list">
                                      <span>English</span>,
                                      <span>Bengali</span>
                                   </div>
                                   
<!--                                   <div class="pull-right" id="edit"><a href=""><i class="fa fa-pencil"></i></a></div>-->
                               </div>
                               <hr>
                               
                               <div class="item">
                                 <div class="item-header">
                                     <h4>Organization</h4>
<!--                                     <a class="pull-right" href=""><i class="fa fa-plus"></i></a>-->
                                 </div>
                                 
                                  <span class="accom-count">2</span>
                                  <div id="list">
                                      <span>Obantor</span>,
                                      <span>Fatfog</span>
                                  </div>
                                   
<!--                                   <div class="pull-right" id="edit"><a href=""><i class="fa fa-pencil"></i></a></div>-->
                               </div>
                           </div>
                            
                            
                            <div id="accom">
                             <div id="accom-header">
                                 <h3>Personal Information</h3>
<!--                                 <a class="pull-right" href=""><i class="fa fa-plus"></i></a>    -->
                             </div>
                             
                              
                               <hr>
                               
                               <div class="item">
                                 <div class="item-header info">
                                     <h4><i class="fa fa-home"></i> <span>House 27,Road 3/b, Sector 9, Uttara, Dhaka</span></h4>
<!--                                     <a class="pull-right" href=""><i class="fa fa-plus"></i></a>-->
                                 </div>
                                 
                                 <div class="item-header info">
                                     <h4><i class="fa fa-envelope"></i> <span>nasim@obantor.com</span></h4>
<!--                                     <a class="pull-right" href=""><i class="fa fa-plus"></i></a>-->
                                 </div>
                                 
                                 <div class="item-header info">
                                     <h4><i class="fa fa-phone"></i> <span>+880 123 456 7</span></h4>
<!--                                     <a class="pull-right" href=""><i class="fa fa-plus"></i></a>-->
                                 </div>
                                 
                               </div>
                           </div>
                            
                                    
                        </div>
                        
                        
                    </div>
                    
                    
                    
                    <div id="sidebar" class="col-sm-3 col-md-3 profile-sidebar">
                
                        <h4>Events</h4>
                        
                        <div class="event-small">
                            <a href=""><img class="img-responsive" src="assets/images/event.jpg" alt=""></a>
                            <span class="details">
                                <a href=""><p><strong>2017 Get Together</strong></p></a>
                                <div class="links">
                                    <a href="">Invite Friends</a>
                                    <a href="">Members</a>
                                    <a href="">Share</a>
                                </div>
                            </span>
                        </div>
                        
                        
                        <div class="event-small">
                            <a href=""><img class="img-responsive" src="assets/images/event.jpg" alt=""></a>
                            <span class="details">
                                <a href=""><p><strong>Birthday Party</strong></p></a>
                                <div class="links">
                                    <a href="">Invite Friends</a>
                                    <a href="">Members</a>
                                    <a href="">Share</a>
                                </div>
                            </span>
                        </div>
                        
                        
                        <div class="event-small">
                            <a href=""><img class="img-responsive" src="assets/images/event.jpg" alt=""></a>
                            <span class="details">
                                <a href=""><p><strong>Halloween</strong></p></a>
                                <div class="links">
                                    <a href="">Invite Friends</a>
                                    <a href="">Members</a>
                                    <a href="">Share</a>
                                </div>
                            </span>
                        </div>
                    
                    </div>
                    
                    
                </div>
            </div>
        </section>    
        
        @endsection