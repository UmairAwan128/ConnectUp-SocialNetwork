<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //middleware('guest'); means this view is for users which are not loggedIN
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //following are validation rules
        //for the values given by form to this action
        
        //"confirmed" written inside 'password'=>[-------]
        // down here means in the form both password and 
        //confirm_password fields content should be same 
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'f_name' => ['required', 'string'],
            'l_name' => ['required', 'string'],
            'birthday' => ['required'],
        ]);
        //for other dtails
        //https://laravel.com/docs/5.7/validation#available-validation-rules
    
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
     //the request is submitted here in this controller action "register"
     //ConnectUp\vendor\laravel\framework\src\Illuminate\Foundation\Auth\RegistersUsers.php
     //then its redirected here
     //also showRegistrationForm() is also there which returns which Registrationform View
     //and pass genders and countries to the view    
     protected function create(array $data)
     {
        //for displaying the text into the browser
        //dd($data);
        // print_r($data);
        $first_name = $data['f_name'];
        $last_name = $data['l_name'];
       
        $newgid = sprintf('%05d', rand(0,999999)); //generated a random no b/w 0 to 9999999
        //for unique username after each user_name append a random number
        $username = strtolower($first_name ."_". $last_name . "_" .$newgid);

        $rand = rand(1,3); //generate no b/w 1 to 3
        //and assign any of the name of the image
        if($rand == 1){
             $profile_pic = "user1.png";
        }
        else if($rand == 2){
            $profile_pic = "user2.png";
        }
        else if($rand == 3){
            $profile_pic = "user3.png";
        }

        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'f_name' => $data['f_name'],
            'l_name' => $data['l_name'],
            'birthday' => $data['birthday'],
            'country'=>$data['country'],
            'gender'=>$data['gender'],
            'name' => $username,
            'profilePic' => $profile_pic,
            'cover'=>'default_cover.jpg',
            'posts'=>'no',
            'status'=>'not verified',
            'recoverAccountString'=>'recover my account',
        ]);
    }
}
