@if(count($users) > 0)
  @foreach($users as $user)


        <div class='row'>
                <div class='col-sm-3'> 
                </div> 
                <div class='col-sm-6'>

                    <div class='tr-section'>
                    <div class='tr-post'>
                    <div class='entry-header'>
                    <div class='entry-thumbnail'>
                    <a href='/Profile?id={{ $user->id }}'><img class='img-fluid' src='/storage/users_covers/{{ $user->cover }}' alt='Image'></a>
                    </div><!-- /entry-thumbnail -->
                    </div><!-- /entry-header -->
                    <div class='post-content'>
                    <div class='author-post text-center'>
                    <a class='ToggeleProfileBtn' href='/Profile?id={{ $user->id }}'><img class='img-fluid rounded-circle' src='/storage/users_profiles/{{ $user->profilePic }}' alt='Image'></a>
                    </div><!-- /author -->
                    <div class='card-content'>
                    <h4>{{ $user->f_name }} {{ $user->l_name }}</h4>
                    <span>{{ $user->email }}</span>
                    </div>
                    <a href='#' class='kafe-btn kafe-btn-mint-small full-width'> Follow
                    </a>		  
                    </div><!-- /.post-content -->									
                    </div><!-- /.tr-post -->	
                </div><!-- /.tr-post --> 
                    </div>   
            
                <div class='col-sm-3'> 
                </div> 
        </div><br>    

@endforeach
          
<center>
{{-- call links() method on object we get from the controller now this will generate
    pageNo,next,pre buttons --}}
    {{$users->links()}} 
</center>

@else
<p>No Users found</p>
@endif
