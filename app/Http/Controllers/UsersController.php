<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; //now we can use the Post model hence the posts table


class UsersController extends Controller
{
    public function index(Request $request)
    {
        //if the request is ajax
        if($request->ajax()){
            $users = User::orderBy('created_at','desc')->paginate(2);
            return view('users/index')->with('users', $users)->render();
        }     
    }


    //this returns a partial_view "users" which contains only users 
    //according to the page passed  
    public function getUsersPagination(Request $request) //like api reurning posts but with partial view
    {
        //if the request is ajax
        if($request->ajax()){
            $users = User::orderBy('created_at','desc')->paginate(2);
            //return view('posts/index')->with('posts', $posts)->render(); whats happening here
            // view('posts/index')->with('posts', $posts)      means pass $posts to view
            //then on this view with Posts data we used render() this will convert the
            //this final view to an object/string/variable and returns it as ajax call result
            // or pass it to  success:function(data){}  i.e in place of data
            return view('users/users')->with('users', $users)->render();
        }

    }



    public function searchUser(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = User::where('name', 'like', '%'.$query.'%')
            ->orWhere('email', 'like', '%'.$query.'%')
            ->orWhere('country', 'like', '%'.$query.'%')
            ->orWhere('f_name', 'like', '%'.$query.'%')
            ->orWhere('l_name', 'like', '%'.$query.'%')
            ->orderBy('gender', 'desc')
            ->get();
      }
      else
      {
       $data = User::orderBy('created_at', 'desc')->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $user)
       {
        $output .= "
       
            <div class='row'>
            <div class='col-sm-3'> 
            </div> 
            <div class='col-sm-6'>

                <div class='tr-section'>
                <div class='tr-post'>
                <div class='entry-header'>
                <div class='entry-thumbnail'>
                <a href='/Profile?id=$user->id'><img class='img-fluid' src='/storage/users_covers/$user->cover' alt='Image'></a>
                </div><!-- /entry-thumbnail -->
                </div><!-- /entry-header -->
                <div class='post-content'>
                <div class='author-post text-center'>
                <a class='ToggeleProfileBtn' href='/Profile?id=$user->id'><img class='img-fluid rounded-circle' src='/storage/users_profiles/$user->profilePic' alt='Image'></a>
                </div><!-- /author -->
                <div class='card-content'>
                <h4>$user->f_name  $user->l_name</h4>
                <span> $user->email </span>
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
        ";
       }
      }
      else
      {
       $output = '
         <p>No Users found</p>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

       echo json_encode($data);
     }
    }





}
