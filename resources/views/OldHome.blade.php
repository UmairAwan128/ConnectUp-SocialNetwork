@extends('layouts/main')

@section('content')
<div class="row">
        <div id="insert_post" class="col-sm-12">

                {{-- we used here Form laravel component which was in pre versoins of laravel
                all things removed can be found here  
                https://laravelcollective.com/
                //we need form so for installing form follow the installation instructions
                https://laravelcollective.com/docs/master/html#installation
                //all form features/stuff are explained here
                https://laravelcollective.com/docs/master/html
                //see this its important(Limitations)
                https://laravelcollective.com/docs/master/html#important
                //for this after installation we also added ref in app.php in provider & aliases   
                --}}

                {{-- also in place of 'action'=>'aasd@as'  we can use  'url' =>'sd/asd'  --}}
            <center>
       
              
                    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
   
                            {{-- to use msWord like editting features use ck-editor installation also here 
                            https://github.com/UniSharp/laravel-ckeditor 
                            include these two scripts and assign id="content" to textarea 
                            on which you want these features its JS is written in main.blade.php--}}
                            {{-- {{Form::textarea('body', '', ['id' => 'content', 'class' => '', 'placeholder' => "What's in your mind?"])}} --}}
                            {{-- {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}} --}}
           
                           <textarea class="form-control no-border" style="resize: none;"  id="content" rows="4" name="content" placeholder="asd"></textarea><br>      
   
                            <label style="cursor: pointer;" class="nav-item" id="upload_image_button">Select Image
                                <i class="fa fa-camera text-muted"> <input type="file" name="upload_image" size="300"> Image</i>
                            </label>
        
                            {{Form::submit('Submit', ['id' => 'btn-post','class'=>'kafe-btn kafe-btn-mint-small btn-sm'])}}
           
                    {!! Form::close() !!}
      
                {{-- insertPost() --}}
            </center>
        </div>
</div>
    
     <div class="row" >
         
        <div class='col-sm-3'>
        </div>
        <div class="col-sm-6">
             <section class="newsfeed">
                {{-- this div will bydefault have all the posts i.e news feed but
                    on changing of the navtab e.g to profile an ajax call will be
                    made to replace this div content with the profile page data --}}
                <div class="container-fluid" id="Home_Posts_div">
                    @include('posts/index')
                </div>
             </section>
        </div>
        
        <div class='col-sm-3'>
        </div>
     </div>
     
@endsection




