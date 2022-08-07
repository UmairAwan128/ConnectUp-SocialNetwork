<!DOCTYPE html>

<html>
  <!-- Mirrored from themashabrand.com/templates/Fluffs/photo_home.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 13 Dec 2018 16:42:18 GMT -->
  <head>
  
    <!-- ==============================================
    Title and Meta Tags
    =============================================== -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:description" content="" />		
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- ==============================================
    Favicons
    =============================================== --> 
    <link rel="icon" href="img/logo.html">
    <link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.html">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-touch-icon-72x72.html">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-touch-icon-114x114.html">

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- ==============================================
    CSS
    =============================================== -->
    <link type="text/css" href="css/demos/photo.css" rel="stylesheet" />
            
    <!-- ==============================================
    Feauture Detection
    =============================================== -->
    <!-- <script src="assets/js/modernizr-custom.html"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->	
    <link rel="stylesheet" type="text/css" href="Style/home_style2.css"/>

</head>
<body style="background: #f4f4f4">
    
    <div>
        
        <div id="GoToTop"></div>

        @include('partials/navbar')
    
  
        <br/>
        <div class="alert" id="mainMessage" style="display: none"></div>
        <br/>
  
        <div class="MainContentDiv">
            @yield('content')    
        </div>  

    </div>  
    
    <script src="js/myScript.js"></script>
    
    {{-- to use msWord like editting features use ck-editor installation also here 
        https://github.com/UniSharp/laravel-ckeditor 
        include these two scripts and assign id="article-ckeditor" to textarea 
        on which you want these features--}}
      
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>

     
        function advancedEdittingForPost(){
            //here we did onFocus of the post create content text field we
            //applied ck_editor library on so it will get features like bold/underline e.t.c 
            var x = document.getElementById("content");
            if(x!=null){
            x.addEventListener("focusin", myFocusFunction);
            }
        }
        function myFocusFunction() {
            CKEDITOR.replace( 'content' );
            
            $('#select_PostImageLabel').css({
                'top' : '70.5%',
                'right': '1%',
            });                   
            $('#PostImageBox').css({
                'top' : '40%',
                'right': '1%',
           
            });                   

            $('#advancedEditBtnLabel').css('display', 'none');   

        }


        //For CheckBox to Show or hide Password in edit_profile.blade.php  
        function show_password() {  
            $('#mypass').attr('type', $('#showPasswordCheck').is(':checked') ? 'text' : 'password');  
        }


            //for submitting form with ajax or send data to server/controller with 
            //ajax first write this   
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });

            //onLoad Of Page Load the Home Page
            $.ajax({
                  url:"/homeContent",
                  success:function(data){
                      //which will replace the previous html/posts
                     $('.MainContentDiv').html(data);
                                    
                  }
            });      


            $(document).on('change','#select_PostImage',function(event){                            
                //the select_PostImage <input> is currently hidden due to 
                //style/css of this theme so on its change first bring it
                //back but not displaying it then get its value and pass
                //to ajax call
                $('#select_PostImage').css('display', 'none');
                    var name = document.getElementById("select_PostImage").files[0].name;
                    var form_data = new FormData();
                    var ext = name.split('.').pop().toLowerCase();
                    if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
                    {
                    alert("Invalid Image File");
                    }
                    var oFReader = new FileReader();
                    oFReader.readAsDataURL(document.getElementById("select_PostImage").files[0]);
                    var f = document.getElementById("select_PostImage").files[0];
                    var fsize = f.size||f.fileSize;
                    if(fsize > 2000000)
                    {
                      alert("Image File Size is very big");
                    }
                    else
                    {
                        //file or image will be accessed on the server side by name "file"
                        //as we write here
                        form_data.append("file", document.getElementById('select_PostImage').files[0]);
                    
                    $.ajax({
                        url:"/Shared/UploadImage",
                        method:"POST",
                        data: form_data,
                        dataType:'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        
                        success:function(data)
                        {
                            $('#message').css('display', 'block');
                            $('#message').html(data.message);
                            $('#message').addClass(data.class_name);
                            $('#PostImageBox').attr("src", data.uploaded_image_dest);
                            
                        }
                    });
                }

            });



            //wrote outside as ajax call is also outside above here
            $(document).on('submit','#createPost_form',function(event){
                    event.preventDefault();
                    debugger;
                    $.ajax({
                    url:"/posts",
                    method:"POST",
                    data: new FormData(this),
                    // dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                })
                .done(function (data) {

                    $( "#Home_Posts_div" ).prepend(data);
                    $('#mainMessage').css('display', 'block');
                    $('#mainMessage').html("Your Post Created Successfully.(@_@/)");
                    $('#mainMessage').addClass('alert-success');
                    $('#content').val('');
                    $('#PostImageBox').attr("src", "/storage/posts_images/noimage.png");
                                   
                    // $('body.cke_editable').html();
                    
                    $("html, body").animate({ scrollTop: 0 }, 500);

                })
                .fail(function(data) {
                 
                    $('#mainMessage').css('display', 'block');
                    $('#mainMessage').html("Some thing went wrong.(-_-!)"+data);
                    $('#mainMessage').addClass('alert-danger');
                 
                });

            });       


            //we wrote this form not inside the ajax call of Messages ajax as there
            //the ajax calls were going in an increasing order like 1st time 1 call
            //but then as we again click the same user to chat so agin chat head loads
            //this time two msgs go on just one msg send and then next time 4 and sooon 
            $(document).on('submit','#createMessage_form',function(event){
                
                event.preventDefault();
                var form_data = $(this).serialize(); //Encode form elements for submission
                
                var allFormFields = $('#editProfile_form').serialize();
                $.ajax({
                    url:"/Messages/create",
                    type: 'POST',
                    data:form_data,
                        success:function(data){
                            $( ".conversation-container" ).append(data);
                            //scroll to the bottom of the conversation i.e to last msg
                            //or this new message generated now
                            var div = document.getElementById("scroll_messages");
                            div.scrollTop = div.scrollHeight;
                            //remove msg sent from the input field
                            ("#message_textarea").val("");
                        }
                }); 
                        
            }); 






        //for Home page Pagination on ajax we did this          
        $(document).ready(function(){
          

            //on click of any element which is <a> inside the pagination class <div>
            $(document).on('click','.newsfeed .pagination a',function(){
              
                  event.preventDefault();
                  //first we get the current pageNo from link
                  // http://127.0.0.1:8000/home?page=1
                  //so split link on the basis of 'page=' so we get two parts
                  //i.e [0]=>'http://127.0.0.1:8000/home?page='
                  //    [1]=>'2' 
                  //i.e page no is in second location i.e [1] so
                  //we get the current pageNo
                  var pageNo = $(this).attr('href').split('page=')[1];
                  $.ajax({
                      url:"/posts?page="+pageNo,
                      success:function(data){
                          //which will replace the previous html/posts
                         $('#Home_Posts_div').html(data);
                         $("html, body").animate({ scrollTop: 0 }, 500);
                      }
                  });      
            });

           

            $(document).on('click','.ToggleHomeBtn',function(){
              
              event.preventDefault();
              $.ajax({
                  url:"/homeContent",
                  success:function(data){
                      //which will replace the previous html/posts
                     $('.MainContentDiv').html(data);
                     $("html, body").animate({ scrollTop: 0 }, 500);
                    
                     //select the specific tab             
                     $('#HomeNavButtonDiv').attr( "class", "p-2 nav-icon-lg mint-green" );
                     $('#FindFriendsNavButtonDiv').attr( "class", "p-2 nav-icon-lg clean-black" );
                     $('#MessagesNavButtonDiv').attr( "class", "p-2 nav-icon-lg dark-black" );
                     $('#SettingsNavButtonDiv').attr( "class", "p-2 nav-icon-lg clean-black" );
                     $('#ProfileNavButtonDiv').attr( "class", "p-2 nav-icon-lg dark-black" );
            
                      //the code for post creation and submit is outside as in start
                      //the auto ajax call is outside so the code for submit and craete
                      //post should be outside
                    }
                });      
            });


            $(document).on('click','.ToggleMessagesBtn',function(){
              
              event.preventDefault();
              $.ajax({
                  url:"/Messages/index",
                  success:function(data){
                      //which will replace the previous html/posts
                     $('.MainContentDiv').html(data);
                     $("html, body").animate({ scrollTop: 0 }, 500);
                    
                     //select the specific tab             
                     $('#HomeNavButtonDiv').attr( "class", "p-2 nav-icon-lg dark-black" );
                     $('#FindFriendsNavButtonDiv').attr( "class", "p-2 nav-icon-lg clean-black" );
                     $('#MessagesNavButtonDiv').attr( "class", "p-2 nav-icon-lg mint-green" );
                     $('#SettingsNavButtonDiv').attr( "class", "p-2 nav-icon-lg clean-black" );
                     $('#ProfileNavButtonDiv').attr( "class", "p-2 nav-icon-lg dark-black" );

                     $.ajax({
                            url:"/Messages/allUsersSidePane",
                            method:'GET',
                            dataType:'json',
                            success:function(data)
                            {
                                $('#message-list_UL').html(data);
                            }
                        });
                      
                        
                        $(document).on('click','.startChatwithThisUser',function(){
                            event.preventDefault();
                            var currentUrl = $(this).attr("href");
                            $.ajax({
                                url:currentUrl,
                                success:function(data){
                                    
                                    $('#MessagesChatPane').html(data);
                                    
                                    //scroll bottom of the conversation i.e to last msg
                                    var div = document.getElementById("scroll_messages");
                                    div.scrollTop = div.scrollHeight;

                                    // var div = document.getElementById("scroll_messages");
                                    // div.scrollTop = div.scrollHeight;
  
                                
                                },
                            });      
                        }); 




                    }
                });      
            });

            $(document).on('click','.ToggleFindFriendsBtn',function(){
              
              event.preventDefault();
              $.ajax({
                  url:"/FindFriends",
                  success:function(data){
                      //which will replace the previous html/posts
                     $('.MainContentDiv').html(data);
                     $("html, body").animate({ scrollTop: 0 }, 500);
                    
                     //select the specific tab             
                     $('#HomeNavButtonDiv').attr( "class", "p-2 nav-icon-lg dark-black" );
                     $('#FindFriendsNavButtonDiv').attr( "class", "p-2 nav-icon-lg mint-green" );
                     $('#MessagesNavButtonDiv').attr( "class", "p-2 nav-icon-lg dark-black" );
                     $('#SettingsNavButtonDiv').attr( "class", "p-2 nav-icon-lg clean-black" );
                     $('#ProfileNavButtonDiv').attr( "class", "p-2 nav-icon-lg dark-black" );
                  

                    //wrote the code inside success of this ajax as this will only work if
                    //Profile page is opened so the above ajax opened
                    //the page now below/inside ajax calls will be used to 
                    //chaange to profile/cover change and
                    //for profilePage pagination 
                      $(document).on('click','.FindFriendsPageUsers .pagination a',function(){
                            event.preventDefault();
                            var pageNo = $(this).attr('href').split('page=')[1];
                            
                            $.ajax({
                                // this url i.e /userPosts
                                //is a route defined in web.php so here directly calling
                                //the function of controller will not work like home/create
                                //first define route then call that route   
                                url: '/usersNextPage?page='+pageNo,
                                success:function(data){
                                    $('.FindFriendsPageUsers').html(data);
                                    $("html, body").animate({ scrollTop: 0 }, 500);
                                },
                            });      
                       }); 

                       $(document).on('keyup', '#findFriendsInput', function(){
                            var query = $(this).val();
                            fetch_users(query);
                        }); 

                    }
                });      
            });

            

            function fetch_users(query = '')
            {
                $.ajax({
                    url:"/searchUsers",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function(data)
                    {
                        $('.FindFriendsPageUsers').html(data.table_data);
                        $('#total_records').text(data.total_data);
                    }
                });
            }
            
            $(document).on('keyup', '.findPosts', function(){
                            var query = $(this).val();
                            fetch_posts(query);
            }); 


            function fetch_posts(query = '')
            {
                $.ajax({
                    url:"/searchPosts",
                    method:'GET',
                    data:{query:query},
                    success:function(data)
                    {
                        $('.MainContentDiv').html(data);
                        // $( ".MainContentDiv" ).prepend("<center><h2><strong>Search Result</strong></h2><br/><br/></center>");
                         
                        
                        //wrote the code inside success of this ajax as this will only work if
                        //Profile page is opened so the above ajax opened
                        //the page now below/inside ajax calls will be used to 
                        //chaange to profile/cover change and
                        //for profilePage pagination 
                        $(document).on('click','#SearchResult_Posts_div .pagination a',function(){
                                event.preventDefault();
                                var pageNo = $(this).attr('href').split('page=')[1];
                                
                                $.ajax({
                                    // this url i.e /userPosts
                                    //is a route defined in web.php so here directly calling
                                    //the function of controller will not work like home/create
                                    //first define route then call that route   
                                    url: '/searchPostsNextPage?page='+pageNo,
                                    data:{
                                        query:query,
                                        page:pageNo
                                    },
                                    success:function(data){
                                        $('#SearchResult_Posts_div').html(data);
                                        $("html, body").animate({ scrollTop: 0 }, 500);
                                    },
                                });      
                        });





                    }
                });
            }

            $(document).on('click','.ToggleSettingBtn',function(){
                  event.preventDefault();
                  $.ajax({
                      url:"/editUserProfile",
                      success:function(data){
                          //which will replace the previous html/posts
                         $('.MainContentDiv').html(data);

                         //select the specific tab            
                         $('#HomeNavButtonDiv').attr( "class", "p-2 nav-icon-lg dark-black" );
                         $('#FindFriendsNavButtonDiv').attr( "class", "p-2 nav-icon-lg clean-black" );
                         $('#MessagesNavButtonDiv').attr( "class", "p-2 nav-icon-lg dark-black" );
                         $('#SettingsNavButtonDiv').attr( "class", "p-2 nav-icon-lg mint-green" );
                         $('#ProfileNavButtonDiv').attr( "class", "p-2 nav-icon-lg dark-black" );
                            
                            //wrote the code inside success of this ajax as this will only work if
                            //editProfile page is opened so the above ajax opened
                            //the page now this ajax will be used to submit the page  
                            $(document).on('submit','#editProfile_form',function(event){
                
                                                    
                                event.preventDefault();
                                var form_data = $(this).serialize(); //Encode form elements for submission
                                
                                
                                var allFormFields = $('#editProfile_form').serialize();
                                $.ajax({
                                    url :'/updateUserInformation',
                                    type: 'POST',
                                    data:form_data,
                                        success:function(data){
                                        $( "#mainMessage" ).css( "display", "block" );
                                        $("#mainMessage").html(data.message);
                                        $("#mainMessage").addClass(data.class_name);

                                        $("html, body").animate({ scrollTop: 0 }, 500);
                                    }
                                }); 
                            
                            }); 

                      
                      } //end of successs
                  });      
        });

        $(document).on('click','.ToggeleProfileBtn',function(){
                  event.preventDefault();
                  var currentUrl = $(this).attr("href");
                  $.ajax({
                      url:currentUrl,
                      success:function(data){

                          //which will replace the previous html/posts
                         $('.MainContentDiv').html(data);
                         $("html, body").animate({ scrollTop: 0 }, 500);

                         //select the specific tab            
                         $('#HomeNavButtonDiv').attr( "class", "p-2 nav-icon-lg dark-black" );
                         $('#FindFriendsNavButtonDiv').attr( "class", "p-2 nav-icon-lg clean-black" );
                         $('#MessagesNavButtonDiv').attr( "class", "p-2 nav-icon-lg dark-black" );
                         $('#SettingsNavButtonDiv').attr( "class", "p-2 nav-icon-lg clean-black" );
                         $('#ProfileNavButtonDiv').attr( "class", "p-2 nav-icon-lg mint-green" );
                          

                            //wrote the code inside success of this ajax as this will only work if
                            //Profile page is opened so the above ajax opened
                            //the page now below/inside ajax calls will be used to 
                            //chaange to profile/cover change and
                            //for profilePage pagination 
                            $(document).on('click','.ProfilePagePosts .pagination a',function(){
                                            event.preventDefault();
                                            var pageNo = $(this).attr('href').split('page=')[1];
                                            
                                            $.ajax({
                                                // this url i.e /userPosts
                                                //is a route defined in web.php so here directly calling
                                                //the function of controller will not work like home/create
                                                //first define route then call that route   
                                                url: '/userPosts?page='+pageNo,
                                                success:function(data){
                                                    $('.ProfilePagePosts').html(data);
                                                    $("html, body").animate({ scrollTop: 0 }, 500);
                          
                                                },
                                            });      
                                    });


                            
                                        // default orignal               
                                    
                                    $('#updateProfile_form').on('submit', function(event){
                                                
                                        event.preventDefault();
                                            $.ajax({
                                            url:"/UpdateProfile",
                                            method:"POST",
                                            data: new FormData(this),
                                            dataType:'JSON',
                                            contentType: false,
                                            cache: false,
                                            processData: false,
                                            success:function(data)
                                            {
                                                $('#message').css('display', 'block');
                                                $('#message').html(data.message);
                                                $('#message').addClass(data.class_name);
                                                $('#ProfileImageBox').attr("src", data.uploaded_image_dest);
                                                $('#updateProfileButton').css('display', 'none');
                                                $('.update_profile').css('top', '-33px');
                                            }
                                            });
                                    });


                                    $("#select_ProfilePic").change(function(event){
                                        
                                        //the select_ProfilePic <input> is currently hidden due to 
                                        //style/css of this theme so on its change first bring it
                                        //back but not displaying it then get its value and pass
                                        //to ajax call
                                        $('#select_ProfilePic').css('display', 'none');
                                    
                                            var name = document.getElementById("select_ProfilePic").files[0].name;
                                            var form_data = new FormData();
                                            var ext = name.split('.').pop().toLowerCase();
                                            if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
                                            {
                                            alert("Invalid Image File");
                                            }
                                            var oFReader = new FileReader();
                                            oFReader.readAsDataURL(document.getElementById("select_ProfilePic").files[0]);
                                            var f = document.getElementById("select_ProfilePic").files[0];
                                            var fsize = f.size||f.fileSize;
                                            if(fsize > 2000000)
                                            {
                                            alert("Image File Size is very big");
                                            }
                                            else
                                            {
                                                //file or image will be accessed on the server side by name "file"
                                                //as we write here
                                            form_data.append("file", document.getElementById('select_ProfilePic').files[0]);
                                            
                                            $.ajax({
                                                url:"/Shared/UploadImage",
                                                method:"POST",
                                                data: form_data,
                                                dataType:'JSON',
                                                contentType: false,
                                                cache: false,
                                                processData: false,
                                                
                                                success:function(data)
                                                {
                                                    $('#message').css('display', 'block');
                                                    $('#message').html(data.message);
                                                    $('#message').addClass(data.class_name);
                                                    $('#ProfileImageBox').attr("src", data.uploaded_image_dest);
                                                    //show both buttons update_profile class is applied
                                                                    //on both butons 
                                                    $('.update_profile').css('display', '');
                                                    $('.update_profile').css('top', '-65px');
                                                    
                                                }
                                            });
                                        }

                                    });



                                    $("#select_CoverPic").change(function(event){
                                        
                                        //the select_CoverPic <input> is currently hidden due to 
                                        //style/css of this theme so on its change first bring it
                                        //back but not displaying it then get its value and pass
                                        //to ajax call
                                        $('#select_CoverPic').css('display', 'none');
                                    
                                            var name = document.getElementById("select_CoverPic").files[0].name;
                                            var form_data = new FormData();
                                            var ext = name.split('.').pop().toLowerCase();
                                            if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
                                            {
                                            alert("Invalid Image File");
                                            }
                                            var oFReader = new FileReader();
                                            oFReader.readAsDataURL(document.getElementById("select_CoverPic").files[0]);
                                            var f = document.getElementById("select_CoverPic").files[0];
                                            var fsize = f.size||f.fileSize;
                                            if(fsize > 2000000)
                                            {
                                            alert("Image File Size is very big");
                                            }
                                            else
                                            {
                                                //file or image will be accessed on the server side by name "file"
                                                //as we write here
                                            form_data.append("file", document.getElementById('select_CoverPic').files[0]);
                                            
                                            $.ajax({
                                                url:"/Shared/UploadImage",
                                                method:"POST",
                                                data: form_data,
                                                dataType:'JSON',
                                                contentType: false,
                                                cache: false,
                                                processData: false,
                                                
                                                success:function(data)
                                                {
                                                    $('#message').css('display', 'block');
                                                    $('#message').html(data.message);
                                                    $('#message').addClass(data.class_name);
                                                    $('#update_CoverPic').css('display', '');
                                                    
                                                    $('#CoverImageBox').css({
                                                        'background' : 'linear-gradient( rgba(34,34,34,0.45), rgba(34,34,34,0.45)), url('+data.uploaded_image_dest+') no-repeat',
                                                        'background-size': 'cover',
                                                        'background-position': 'center',
                                                        '-webkit-background-size': 'cover',
                                                        '-moz-background-size': 'cover',
                                                        '-o-background-size': 'cover'
                                                    });                   
                                                }
                                            });
                                        }

                                    });


                                    $('#updateCover_form').on('submit', function(event){
                                                    
                                        event.preventDefault();
                                            $.ajax({
                                            url:"/UpdateCover",
                                            method:"POST",
                                            data: new FormData(this),
                                            dataType:'JSON',
                                            contentType: false,
                                            cache: false,
                                            processData: false,
                                            success:function(data)
                                            {
                                                $('#message').css('display', 'block');
                                                $('#message').html(data.message);
                                                $('#message').addClass(data.class_name);
                                                $('#CoverImageBox').css({
                                                    'background' : 'linear-gradient( rgba(34,34,34,0.45), rgba(34,34,34,0.45)), url('+data.uploaded_image_dest+') no-repeat',
                                                    'background-size': 'cover',
                                                    'background-position': 'center',
                                                    '-webkit-background-size': 'cover',
                                                    '-moz-background-size': 'cover',
                                                    '-o-background-size': 'cover'
                                                });                   

                                                $('#update_CoverPic').css('display', 'none');            
                                            }
                                            });
                                    });


                        }// end of success of profileNavButtonClick
                  });      
        });


    });
        
    </script>           


    @yield('javascriptcode')  

</body>
 </html>
