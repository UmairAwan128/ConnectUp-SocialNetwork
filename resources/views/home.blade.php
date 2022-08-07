<div class="row">
        <div id="insert_post" class="col-sm-12">

            <center>
       
                    <form method="post" id="createPost_form" enctype="multipart/form-data">

                           <textarea class="form-control no-border" style="resize: none;"  id="content" rows="5" name="content" placeholder="What's in your mind....."></textarea><br>      
   
                            <label id="select_PostImageLabel" style="cursor: pointer;" class="nav-item upload_image_group" >
                                <i class="fa fa-camera text-muted"> <input type="file" id="select_PostImage" name="PostImage" size="300"> Image </i>
                            </label>
                            <img style="top:40%;right:6%" class="img-responsive upload_image_group" id="PostImageBox" src="/storage/posts_images/noimage.png" alt="PostImage">
                            <input id='btn-post' type="submit" name="updateProfilePic" class="kafe-btn kafe-btn-mint-small btn-sm" value="Submit"/>

                            <label id="advancedEditBtnLabel" style="cursor: pointer; right:72%" class="nav-item upload_image_group">
                                    <i class="fa fa-wrench text-muted"> <input type="button" id="advancedEditBtn" onclick="advancedEdittingForPost()" style="display:none">Adv_Edit</i>
                            </label>
                         
                    </form>  
                             
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
                
                <center><h2><strong>News Feed</strong></h2><br/><br/></center>

                <div class="container-fluid" id="Home_Posts_div">
                    @include('posts/index')
                </div>
             </section>
        </div>
        
        <div class='col-sm-3'>
        </div>
     </div>
     




