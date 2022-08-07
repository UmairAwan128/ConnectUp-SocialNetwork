<div class="row">
        <div class="col-sm-12">
            <center>
                <h2>Find New People</h2>
            </center></br></br>
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                  <form class="search_form" action="">
                        <input placeholder="Find Your Friend" id="findFriendsInput" name="search_user" type="text">
                        <button disabled name="search_user_btn" id="findFriendsBtn"><i class="fa fa-search" id="total_records"></i></button>
                        <button class="ToggleFindFriendsBtn" ><i class="fa fa-group">All</i></button>                              
                  </form>
                </div>
                <div class="col-sm-4">
                </div>
            </div><br><br> 
        </div>
</div>

<div class="FindFriendsPageUsers">
        @include('users/users')
</div>
