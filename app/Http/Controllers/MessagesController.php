<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use DB;
use Validator;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if the request is ajax
        if($request->ajax()){     
            return view('messages/index')->render();
        }
    }


    public function allUsersSidePane(Request $request)
    {
        //if the request is ajax
        if($request->ajax()){
            
            $users = User::all(); 
            
            $total_users = $users->count();
            $currentUser = auth()->user()->id;
            $output = ''; 
            if($total_users > 0)
            {
             foreach($users as $user)
             {
                //get last message b/w loggedIn user and the the current user in the loop
                //so the last message of conversation b/w currentLooping and loggedIn user    
               
                // $lastMessage = DB::select('SELECT * FROM messages WHERE    
                // (user_to = "'.$user->id.'" AND user_from = "'.$currentUser.'") OR
                // (user_to = "'.$currentUser.'" AND user_from = "'.$user->id.'") 
                // ORDER by 1 Desc LIMIT 1');
            
                // DB::select("SELECT * FROM messages WHERE 
                // (user_to = '$user->id' AND user_from = '$currentUser') OR
                // (user_to = '$currentUser' AND user_from = '$user->id') 
                // ORDER by 1 Desc LIMIT 1");
                
                $lastMessage =  DB::select('SELECT * FROM messages WHERE 
                (user_to = ? AND user_id = ?) OR
                (user_to = ? AND user_id = ?) 
                ORDER by 1 Desc LIMIT 1',[$user->id,$currentUser,$currentUser,$user->id]);
                
                    
                // $total_messages = $lastMessage->count();
     
                if(count($lastMessage) === 0){

                    $last_msg_content = "";
                    $last_msg_date = "";
                }
                else{
                    $last_msg_content = $lastMessage[0]->content;
                    $last_msg_date = $lastMessage[0]->created_at;
                }
                
                
                $output .= "
                    <li class='active' style='margin-bottom:5px;'>
                    <a class='startChatwithThisUser' style='text-decoration: none; cursor: pointer; color: #3897f0;'  href='/Messages/getbyUser?id=$user->id'>
                    <div class='user-message-details'>
                    <div class='user-message-img' style='height:45px'>
                    <img src='/storage/users_profiles/$user->profilePic' style='width: 45px;height: 45px;'  class='img-responsive img-circle' alt=''>
                    </div>
                    <div class='user-message-info'>
                    <h4>$user->f_name $user->l_name</h4>
                    <p>$last_msg_content</p>
                    <span class='time-posted'>$last_msg_date</span>
                    </div><!--/ user-message-info -->
                    </div><!--/ user-message-details -->
                    </a>
                    </li> 
                    
              ";
             }
            }
            else
            {
             $output = '
               <p>No Users found</p>
             ';
            }
            
            echo json_encode($output);
            
        }
    }


    //will return messages of the current user with other user whose id is 
    //passed to it 
    public function getChatPaneByUser(Request $request)
    {
        if($request->ajax())
        {
            $userToId = $request->get('id');
            //get the user to which current user wants to chat
            $userToChat = User::find($userToId);
            
            $currentUserId = auth()->user()->id;
            
            //get all messagess b/w the both users
            $Messages =  DB::select('SELECT * FROM messages WHERE 
                (user_to = ? AND user_id = ?) OR
                (user_to = ? AND user_id = ?) 
                ORDER by 1 Asc',[$userToChat->id,$currentUserId,$currentUserId,$userToChat->id]);

            return view('messages/ChatPane')->with('userToChat', $userToChat)->with('Messages', $Messages)->render();
    
        }
    }
    
    
    public function createMessage(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'msgBody' => 'required',
        ]);
        
        //it is a hidden field in message send form which is the id of the 
        //user to which we are chatting
        $user_toId = $request->input('user_to');
        $userToChat = User::find($user_toId);
     
         // get current user
        $currentUserId = auth()->user()->id;
        
        //if validation is passed
        if($validation->passes())
        {
            // Handle File Upload
            // Create Post
            $message = new Message;
            $message->content = $request->input('msgBody');
            $message->user_to = $user_toId;
            //which is user_from i.e which user is sending msg is current logined user    
            $message->user_id = $currentUserId;
            $message->seen = false;
            $message->save();

            return view('messages/message')->with('message', $message)->with('userToChat', $userToChat)->render();

        }

    }


}
