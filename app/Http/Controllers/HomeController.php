<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; //now we can use the Post model hence the posts table
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('layouts/main');
    }

    public function indexAjax(Request $request)
    {
        //if the request is ajax
        if($request->ajax()){
            $posts = Post::orderBy('created_at','desc')->paginate(2);
            $sameUser = false; 
            return view('home')->with('posts', $posts)->with('sameUser', $sameUser)->render();
        }     
    }
}
