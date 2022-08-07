<?php

namespace App\Http\Controllers;
use App\Post; //now we can use the Post model hence the posts table
use Illuminate\Http\Request;
use Validator;
use App\User;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //this returns a partial_view which we passed $post data and then this
    //data is used there to generate/design posts and return the posts   
    public function index(Request $request ) //like api reurning posts but with partial view
    {
        //if the request is ajax
        if($request->ajax()){
            //$posts = Post::all();
            //return Post::where('title', 'Post Two')->get();
            //$posts = DB::select('SELECT * FROM posts'); //first at top "use DB;"
            //$posts = Post::orderBy('title','desc')->take(1)->get();
            //$posts = Post::orderBy('title','desc')->get();
            //orderBy "created_at" field desc and the paginate take first 10    
            $sameUser = false; 
            $posts = Post::orderBy('created_at','desc')->paginate(2);
            //return view('posts/index')->with('posts', $posts)->render(); whats happening here
            // view('posts/index')->with('posts', $posts)      means pass $posts to view
            //then on this view with Posts data we used render() this will convert the
            //this final view to an object/string/variable and returns it as ajax call result
            // or pass it to  success:function(data){}  i.e in place of data
            return view('posts/index')->with('posts', $posts)->with('sameUser', $sameUser)->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validating the data recieved to this function as 
        //if either field is empty of cover_image is not img then
        //stop the execution send back error and this error will 
        //assigned to a global error variable or session obj which can be accessible everywhere
        //these errors are displayed in application using the messages.blade.php
        //most of the servers default/max upload size is 2mb so we assigned max sie to img 1.99 mb 
        //check for validation   
        $validation = Validator::make($request->all(), [
            'content' => 'required',
            'PostImage' => 'image|nullable|max:1999'
        ]);
     
         // get current user
        $userid = auth()->user()->id;
        $user = User::find($userid); 

            //if validation is passed
        if($validation->passes())
        {
            // Handle File Upload
            if($request->hasFile('PostImage')){
                // Get filename with the extension
                $filenameWithExt = $request->file('PostImage')->getClientOriginalName();
                // Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('PostImage')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore= $filename.'_'.time().'.'.$extension;
                // Upload Image and save to cover_images folder
                //and that folder will be in storage/app/public and that folder is not 
                //assessible from browser so solution is create these files to root Public
                //folder which is accessible from the browser so we run a command 
                //php artisan storage:link
                //which will make Public root folder as our location for saving files so 
                //files will be in Public/cover_images as well in both locations 

                //inshort the command will create a shortcut of storage folder to Main public folder
                // so files will be accessible now in browser. 
                $path = $request->file('PostImage')->storeAs('public/posts_images', $fileNameToStore);
            }
            else {
                $fileNameToStore = 'noimage.jpg';
            }

            // Create Post
            $post = new Post;
            $post->content = $request->input('content');
            $post->user_id = auth()->user()->id;
            $post->image = $fileNameToStore;
            $post->save();


            $sameUser = false; 
            return view('posts/create')->with('post', $post)->with('sameUser', $sameUser)->render();

        }
        else
        {
            return response()->json([
            'message'   => $validation->errors()->all(),
            ]);
        }

        
    }



    public function searchPosts(Request $request)
    {
        if($request->ajax())
        {
        $output = '';
        $query = $request->get('query');
        if($query != '')
        {
            $data = Post::where('content', 'like', '%'.$query.'%')
                    ->orWhere('created_at', 'like', '%'.$query.'%')
                    ->paginate(2);
            }
        else
        {
            $data = Post::orderBy('created_at', 'desc')->paginate(2);
        }
        $sameUser = false; 
        
        return view('posts/SearchResultPost')->with('posts', $data)->with('sameUser', $sameUser)->render();
    
        }
    }

    //for pagination next page   
    public function searchPostsNextPage(Request $request)
    {
        if($request->ajax())
        {
        $output = '';
        $query = $request->get('query');
        if($query != '')
        {
            $data = Post::where('content', 'like', '%'.$query.'%')
                    ->orWhere('created_at', 'like', '%'.$query.'%')
                    ->paginate(2);
        }
        else
        {
            $data = Post::orderBy('created_at', 'desc')->paginate(2);
        }
        $sameUser = false; 
        
        return view('posts/index')->with('posts', $data)->with('sameUser', $sameUser)->render();
    
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }





}
