<div class='row hideThisPost'>
                            
        <div class='col-sm-12'>
            
        <div class='cardbox'>

        <div class='cardbox-heading'>
        <!-- START dropdown-->
        <div class='dropdown pull-right'>
            <button class='btn btn-secondary btn-flat btn-flat-icon' type='button' data-toggle='dropdown' aria-expanded='false'>
            <em class='fa fa-ellipsis-h'></em>
            </button>
            <div class='dropdown-menu dropdown-scale dropdown-menu-right' role='menu' style='position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;'>
            <a class='dropdown-item hidePost' style='cursor: pointer;'>Hide post</a>
           
            @if( Auth::user()->id == $post->user->id)
               <a href='Functions/delete_post.php?post_id=$post_id' class='dropdown-item hidePost' style='cursor: pointer;'>Delete post</a>                
            @endif
        
        </div>
        </div><!--/ dropdown -->
        <!-- END dropdown-->
    
        @if($sameUser)
           {{-- then the links of the UserName and pic will be # else link --}}
            <div class='media m-0'>
                <div class='d-flex mr-3'>
                  <a href='#GoToTop'><img class='img-responsive img-circle' src='/storage/users_profiles/{{ $post->user->profilePic }}' alt='User'></a>
                </div>
                <div class='media-body'>
                        <p class='m-0'><a style='text-decoration:none; cursor:pointer; color: #05cb95;' href='#GoToTop'>{{ $post->user->name }}</a></p>
                        <small><span>Updated on <strong>{{$post->created_at}}</strong></span></small>
                </div>
            </div><!--/ media -->
         
        @else                                                
           
            <div class='media m-0'>
                    <div class='d-flex mr-3'>
                    <a  class='ToggeleProfileBtn' href='/Profile?id={{ $post->user->id }}'><img class='img-responsive img-circle' src='/storage/users_profiles/{{ $post->user->profilePic }}' alt='User'></a>
                    </div>
                    <div class='media-body'>
                            <p class='m-0'><a style='text-decoration:none; cursor:pointer; color: #05cb95;'   class="ToggeleProfileBtn" href='/Profile?id={{ $post->user->id }}'>{{ $post->user->name }}</a></p>
                            <small><span>Updated on <strong>{{$post->created_at}}</strong></span></small>
                    </div>
            </div><!--/ media -->
            
        @endif

      

    </div><!--/ cardbox-heading -->
        
        <div class='cardbox-item'>

        {{-- as the content is in html form so to convert that to html we did this --}}
        @if($post->content!= null)
           <p><center>{!!$post->content!!}</center></p>
        @endif

        @if($post->image!= "noimage.jpg")
            <a href='#' data-toggle='modal'>
                <img class='img-responsive' id='posts-img' src='/storage/posts_images/{{$post->image}}' alt='MaterialImg'>
            </a> 
        @endif

        </div><!--/ cardbox-item -->
        <div class='cardbox-base'>
        <ul>
            <li><a href='#'><img src='img/users/1.jpg' class='img-responsive img-circle' alt='User'></a></li>
            <li><a href='#'><img src='img/users/2.jpg' class='img-responsive img-circle' alt='User'></a></li>
            <li><a href='#'><img src='img/users/3.jpg' class='img-responsive img-circle' alt='User'></a></li>
            <li><a href='#'><img src='img/users/4.jpg' class='img-responsive img-circle' alt='User'></a></li>
            <li><a href='#'><img src='img/users/5.jpg' class='img-responsive img-circle' alt='User'></a></li>
            <li><a href='#'><img src='img/users/6.jpg' class='img-responsive img-circle' alt='User'></a></li>
            <li><a href='#'><img src='img/users/7.jpg' class='img-responsive img-circle' alt='User'></a></li>
            <li><a href='#'><img src='img/users/8.jpg' class='img-responsive img-circle' alt='User'></a></li>
            <li><a href='#'><img src='img/users/9.jpg' class='img-responsive img-circle' alt='User'></a></li>
            <li><a href='#'><img src='img/users/10.jpg' class='img-responsive img-circle' alt='User'></a></li>
        </ul>
        </div><!--/ cardbox-base -->
        <div class='cardbox-like'>
        <ul>
            <li><a href='#'><i class='fa fa-heart'></i></a><span> 786,286</span></li>
            <li><a href='single.php?post_id=$post_id' class='com'><i class='fa fa-comments'></i></a> <span class='span-last'> 126,400</span></li>
        </ul>
        </div><!--/ cardbox-like -->			  
                
        </div><!--/ cardbox -->	
        
        
        </div>

                
      </div><br><br>