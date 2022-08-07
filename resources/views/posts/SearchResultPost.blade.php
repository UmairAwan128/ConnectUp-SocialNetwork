<div class="row" >
         
    <div class='col-sm-3'>
    </div>
    <div class="col-sm-6">
         <section class="SearchResult">
            {{-- this div will bydefault have all the posts i.e news feed but
                on changing of the navtab e.g to profile an ajax call will be
                made to replace this div content with the profile page data --}}
            
            <center><h2><strong>Search Resut(related posts): </strong></h2><br/><br/></center>

            <div class="container-fluid" id="SearchResult_Posts_div">
                @include('posts/index')
            </div>
         </section>
    </div>
    
    <div class='col-sm-3'>
    </div>
 </div>
