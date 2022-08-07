<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; //now we can use the Post model hence the posts table
use App\User;
use App\Gender;
use App\Country;
use Validator;

class ProfilesController extends Controller
{
    public function indexs(Request $request)
    {
   
        //return view('profile')->with('posts', $posts)->with(Array("cuser" => $currentUser));
       // return view::make('profile', compact('posts','user'));     
        // return view('profile')->with(['user'=>$user]);
        // return view('profile', compact('posts', 'currentUser'));
   
            
        //if the request is ajax
        if($request->ajax()){
            // $userid = auth()->user()->id;
            $id = $request->id; 
            $posts = Post::where('user_id', $id)->orderBy('created_at','desc')->paginate(2);
            $currentUser = User::find($id);
            $sameUser = true; 
 
            //  dd("here"); 
            //return view('posts/index')->with('posts', $posts)->render(); whats happening here
            // view('posts/index')->with('posts', $posts)      means pass $posts to view
            //then on this view with Posts data we used render() this will convert the
            //this final view to an object/string/variable and returns it as ajax call result
            // or pass it to  success:function(data){}  i.e in place of data
            //   dd($currentUser);
            return view('profile')->with('user', $currentUser)->with('posts', $posts)->with('sameUser', $sameUser)->render();
   
        }
   
   
    }


    //this returns a partial_view which we passed $post data and then this
    //data is used there to generate/design posts and return the posts   
    public function getCurrentUsersPost(Request $request) //like api reurning posts but with partial view
    {
        //if the request is ajax
        if($request->ajax()){
            $userid = auth()->user()->id;   
            $posts = Post::where('user_id', $userid)->orderBy('created_at','desc')->paginate(2);
            $sameUser = true; 
            //return view('posts/index')->with('posts', $posts)->render(); whats happening here
            // view('posts/index')->with('posts', $posts)      means pass $posts to view
            //then on this view with Posts data we used render() this will convert the
            //this final view to an object/string/variable and returns it as ajax call result
            // or pass it to  success:function(data){}  i.e in place of data
            return view('posts/index')->with('posts', $posts)->with('sameUser', $sameUser)->render();
        }

    }

    
    public function update_cover(Request $request)
    {
        //validating the data recieved to this function as 
        //if either field is empty of cover_image is not img then
        //stop the execution send back error and this error will 
        //assigned to a global error variable or session obj which can be accessible everywhere
        //these errors are displayed in application using the messages.blade.php
        //most of the servers default/max upload size is 2mb so we assigned max sie to img 1.99 mb 

        $validation = Validator::make($request->all(), [
            'select_CoverPic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
     
     
         // get current user
        $userid = auth()->user()->id;
        $user = User::find($userid);
            
    //if validation is passed
        if($validation->passes())
        {
            // Get filename with the extension
            $filenameWithExt = $request->file('select_CoverPic')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('select_CoverPic')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image and save to users_covers folder
            //and that folder will be in storage/app/public and that folder is not 
            //assessible from browser so solution is create these files to root Public
            //folder which is accessible from the browser so we run a command 
            //php artisan storage:link
            //which will create a shortcut of storage folder to Main public folder
            // so files will be accessible now in browser. 
            $path = $request->file('select_CoverPic')->storeAs('public/users_covers', $fileNameToStore);

            if($request->hasFile('select_CoverPic')){
                $user->cover = $fileNameToStore;
            }
            $user->save();
        
            return response()->json([
                'message'   => 'CoverPic updated Successfully(@_@/).',
                'uploaded_image_dest' => '/storage/users_covers/'.$fileNameToStore,
                'class_name'  => 'alert-success'
                ]);
        }
        else
        {
            return response()->json([
            'message'   => $validation->errors()->all(),
            'uploaded_image_dest' => '',
            'class_name'  => 'alert-danger'
            ]);
        }

    }
    
    
    public function update_profilePic(Request $request)
    {
     
            //dd($request);
        //check for validation   
        $validation = Validator::make($request->all(), [
            'select_ProfilePic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
     
         // get current user
        $userid = auth()->user()->id;
        $user = User::find($userid); 

            //if validation is passed
        if($validation->passes())
        {
            // Get filename with the extension
            $filenameWithExt = $request->file('select_ProfilePic')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('select_ProfilePic')->getClientOriginalExtension();
            // Filename to store
        
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            //details of below line is in above method  
            $path = $request->file('select_ProfilePic')->storeAs('public/users_profiles', $fileNameToStore);
   
            //update the profilePic
            if($request->hasFile('select_ProfilePic')){
                $user->profilePic = $fileNameToStore;
            }
            $user->save();
        
                return response()->json([
                'message'   => 'profile updated Successfully(@_@/).',
                'uploaded_image_dest' => '/storage/users_profiles/'.$fileNameToStore,
                'class_name'  => 'alert-success'
                ]);
        }
        else
        {
            return response()->json([
            'message'   => $validation->errors()->all(),
            'uploaded_image_dest' => '',
            'class_name'  => 'alert-danger'
            ]);
        }
    }

    //this method edits user data
    public function editUserProfile(Request $request)
    {
        //if the request is ajax
        if($request->ajax()){
            $countries = Country::all();
            $genders = Gender::all();
            //return view('posts/index')->with('posts', $posts)->render(); whats happening here
            // view('posts/index')->with('posts', $posts)      means pass $posts to view
            //then on this view with Posts data we used render() this will convert the
            //this final view to an object/string/variable and returns it as ajax call result
            // or pass it to  success:function(data){}  i.e in place of data
            return view('edit_Profile',compact('countries','genders'))->render();
        }
        
    }


    public function updateUserInformation(Request $request)
    {
        //check for validation   
        $userid = auth()->user()->id;
        $user = User::find($userid);

        $validation = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users,email,'.$userid,
            'password' => ['required', 'string', 'min:6'],
            'f_name' => ['required', 'string'],
            'l_name' => ['required', 'string'],
            'birthday' => ['required','date'],
            'Relationship' => ['string'],
        ]);
     
        // get current user

        //if validation is passed
        if($validation->passes())
        {
            $user->f_name = $request->f_name;
            $user->l_name = $request->l_name;
            $user->name = $request->name;
            $user->about = $request->about;
            $user->Relationship = $request->Relationship;
            $user->password = $request->password;
            $user->email = $request->email;
            $user->country = $request->country;
            $user->gender = $request->gender;
            $user->birthday = $request->birthday;
            
            $user->save();
        
                return response()->json([
                'message'   => 'Your Imformation updated Successfully(@_@/).',
                'class_name'  => 'alert-success'
                ]);
        }
        else
        {
            return response()->json([
            'message'   => $validation->errors()->all(),
            'class_name'  => 'alert-danger'
            ]);
        }
    }  
}
