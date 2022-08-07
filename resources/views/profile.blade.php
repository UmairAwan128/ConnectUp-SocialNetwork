
<div class="row">
    <br/>
    <div class="alert" id="message" style="display: none"></div>
    <br/>

    <!--      this div is for some space from left side-->
    <div class="col-sm-12">

        <div>  
          <section class='profile'>
            <div class='container-fluid'>
                <div class='row'>
                  
                  <div class='col-lg-12'>
            
                  <div class='profilebox-large' id="CoverImageBox" 
                    style='background: linear-gradient( rgba(34,34,34,0.45), rgba(34,34,34,0.45)), url("/storage/users_covers/{{ $user->cover }}") no-repeat;
                             background-size: cover;background-position: center;
                             -webkit-background-size: cover;
                             -moz-background-size: cover;
                             -o-background-size: cover;'>		  
                  
                  </div>
           
                   </div>
               
                   
                </div><!--/ row-->	
            </div><!--/ container -->
         </section><!--/ profile -->

        
        @if( Auth::user()->id == $user->id)
                          
          <form method="post" id="updateCover_form" enctype="multipart/form-data">

            <div class='nav pull-left' style='position:absolute; top:10px; left:40px'>
 
                    <label  class='btn btn-info'
                     style="background-color: rgba(0, 0, 0, 0.1); color:white; border-color:rgba(0, 0, 0, 0.1); font-weight: bold;"
                     >Change Cover
                        <input type='file' name='select_CoverPic' id="select_CoverPic" size='60'/>
                    </label> 
               
                    <input id='update_CoverPic' type="submit"
                     style="display:none; background-color: rgba(0, 0, 0, 0.1); color:white; border-color:rgba(0, 0, 0, 0.1); font-weight: bold;"
                      name="update_CoverPic" class="btn btn-primary" value="Update Cover"/>
                    </div>              
            </form>  

        @endif


 
      </div>

        	<div id='profile-img'>
		       <img src='/storage/users_profiles/{{ $user->profilePic }}' alt='Profile' id="ProfileImageBox" class='img-circle' width='200px' height='200px'>
               
               @if( Auth::user()->id == $user->id)
           
                        <form method="post" id="updateProfile_form" enctype="multipart/form-data">

                            {{ csrf_field() }}
                            {{-- <input type="hidden" id="_token" value="{{ csrf_token() }}"> --}}
                            {{-- style="top: -210px;" --}}
                            <label id="updateProfileButton" style="display:none" class="update_profile" > update Profile <input id='button_profile' type="submit" style="display:none" name="updateProfilePic" class="btn btn-primary" value="Upload"/></label>
                            <label class="update_profile"> Change Profile
                                {{-- <input type='file' name='profileImage' id="profileImageInput" /> --}}
                                <input type="file" name="select_ProfilePic" id="select_ProfilePic" />
                            </label>
                            <br><br>

                        </form>  
                
                @endif


            		</div><br>
       
    </div>

</div>
<br> <br> <br> <br> <br> <br> <br>

<section class="profile-two">
	  <div class="container-fluid">
      
       <div class="row">
        <div class="col-lg-1">

        </div>

		<div class="col-lg-3">
     
            <aside id='leftsidebar' class='sidebar'>		  
                <ul class='list'>
                <li>
                <div class='user-info'>
            
                <center><h1><strong>Intro</strong></h2></center>
                 <hr> 
                <div class='detail'>
                    <h4>{{ $user->f_name }} {{ $user->l_name }}</h4>
                    <small>{{ $user->email }}</small>                        
                </div>
                <div class='row'>
                    <div class='col-12'>
                    <a title='facebook' href='#' class=' waves-effect waves-block'><i class='fab fa-facebook'></i></a>
                    <a title='twitter' href='#' class=' waves-effect waves-block'><i class='fab fa-twitter'></i></a>
                    <a title='instagram' href='#' class=' waves-effect waves-block'><i class='fab fa-instagram'></i></a>
                    </div>                                
                </div>
                </div>
                </li>
                <li>
                <hr>
                <small class='text-muted'>Bio: </small>
                <p>{{ $user->about }}</p>
                <hr>
                <small class='text-muted'>Relationship Status: </small>
                <p>{{ $user->Relationship }}</p>
                <hr>
                <small class='text-muted'>Lives in: </small>
                <p>{{ $user->country }}</p>
                <hr>
                <small class='text-muted'>Member Since: </small>
                <p>{{ $user->craeted_at }}</p>
                <hr>
                <small class='text-muted'>Gender: </small>
                <p>{{ $user->gender }}</p>
                <hr>
                <small class='text-muted'>DOB: </small>
                <p>{{ $user->birthday }}</p>
                <hr>
                
                
                </li>                    
                </ul>
            </aside>				

    </div>

    <div class="col-sm-6 ProfilePagePosts">
        @include('posts/index')
    </div>

  </div>
 </div>
</section>

