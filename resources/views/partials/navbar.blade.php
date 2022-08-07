
     <!-- ==============================================
     Navigation Section
     =============================================== -->  
     <header class="tr-header">
        <nav class="navbar navbar-default ">
         <div class="container-fluid">
          <div class="navbar-header">
    
           <a class="navbar-brand" href="home.php"><i class="fab fa-instagram"></i> ConnectUP </a>
          </div><!-- /.navbar-header -->
      
          <div class="navbar-left">
           <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
               {{-- remove --}}
                
            </ul>
           </div>
          </div><!-- /.navbar-left -->
          <div class="navbar-right">                          
           <ul class="nav navbar-nav">
             <li>
             <div class="search-dashboard" style="margin-top:10px;padding-left:120px; ">
                 <form method="get" action="" style="width: 544px;" class="hidden-sm visible-md visible-lg">
                      <input class="findPosts" placeholder="Search Posts" name="user_query" type="text">
                      <button disabled name="search"><i class="fa fa-search"></i></button>
                 </form>
                 <form method="get" action="" style="width: 254px;" class="hidden-lg hidden-md" >
                      <input class="findPosts" placeholder="Search Posts" name="user_query" type="text">
                      <button disabled name="search"><i class="fa fa-search"></i></button>
                 </form>
  
              </div>							
             </li>
  
            
  
             <li class=" notification-list" style="margin-bottom:10px;padding-left:120px; ">
                  <a class=" nav-link arrow-none waves-effect" href="messages.php?u_id=new">
                  <i class="fa fa-envelope noti-icon"></i><span class="badge badge-success badge-pill noti-icon-badge">0</span>
                  </a>
             </li>
  
  
           <li class="dropdown mega-avatar" style="margin-bottom:10px ">
            <a  href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
             <span class="avatar w-32"><img src='/storage/users_profiles/{{ Auth::user()->profilePic }}' class="img-resonsive img-circle" width="25" height="25" alt="..."></span>
             <!-- hidden-xs hides the username on small devices so only the image appears. -->
             <span class="">
               {{ Auth::user()->f_name }} {{ Auth::user()->l_name }}
             </span>
            </a>
            <div class="dropdown-menu w dropdown-menu-scale pull-right">
             <a class="dropdown-item" href="my_post.php?u_id="><span>My Posts</span></a> 
             <div class="dropdown-divider"></div>
             <a class="dropdown-item ToggeleProfileBtn" href="/Profile?id={{ Auth::user()->id }}"><span>Profile</span></a> 
             <a class="dropdown-item ToggleSettingBtn " href="#"><span>Settings</span></a> 
             <div class="dropdown-divider"></div>
             
             <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                       {{ __('Logout') }}
             </a>
             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
             </form>

           </li><!-- /navbar-item -->	
   
           </ul><!-- /.sign-in -->   
          </div><!-- /.nav-right -->
         </div><!-- /.container -->
        </nav><!-- /.navbar -->
       </header><!-- Page Header --> 
    

<!-- ==============================================
	 Navbar Second Section
	 =============================================== -->
     <section class="nav-sec">
        <div class="d-flex justify-content-between">

         <div class="p-2 nav-icon-lg mint-green" id="HomeNavButtonDiv" >
         <a class="nav-icon ToggleHomeBtn" href="#"><em class="fa fa-home"></em>
          <span>Home</span>
         </a>
         </div>
         
         <div class="p-2 nav-icon-lg clean-black" id="FindFriendsNavButtonDiv">
         <a class="nav-icon ToggleFindFriendsBtn" href="#"><em class="fa fa-crosshairs"></em>
          <span>Find Friends</span>
         </a>
         </div>

         <div class="p-2 nav-icon-lg dark-black" id="MessagesNavButtonDiv">
         <a class="nav-icon ToggleMessagesBtn" href="#"><em class="fa fa-envelope"></em>
          <span>Messages</span>
         </a>
         </div>
         <div class="p-2 nav-icon-lg clean-black" id="SettingsNavButtonDiv">
        <a class="nav-icon ToggleSettingBtn" href="#" ><em class="fas fa-cog"></em>
        <span>Settings</span>
         </a>
         </div>
         <div class="p-2 nav-icon-lg dark-black" id="ProfileNavButtonDiv">
         <a class="nav-icon ToggeleProfileBtn" href="/Profile?id={{ Auth::user()->id }}"><em class="fa fa-user"></em>
          <span>Profile</span>
         </a>
         </div>
        </div>
      </section>	
  