<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
//MustVerify email is for the email verification feature enabling
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','f_name','l_name','about'
        ,'Relationship','email_verified_at','birthday','profilePic',
        'cover','status','posts','country','gender','recoverAccountString',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    //defines relation b/w country and user
    //user can have only one country 
    public function country(){
        //belongTo tell single obj not many
        //telling here the name of the model to which its relation with  
        return $this->belongsTo('App\Country');
    }

    //defines relation b/w gender and user
    //user can have only one gender 
    public function gender(){
        //belongTo tell single obj not many
        //telling here the name of the model to which its relation with  
        return $this->belongsTo('App\Gender');
    }

    //defines relation b/w user and gender is gender belongs to many users
    public function posts(){
        return $this->hasMany('App\Post');
    }


    //defines relation b/w user and gender is gender belongs to many users
    public function messages(){
        return $this->hasMany('App\Message');
    }

}
