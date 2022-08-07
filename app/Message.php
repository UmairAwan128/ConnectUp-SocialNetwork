<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //defines relation b/w message and user
    //user can have any no of messages and message  
    public function user(){
        //belongTo only one user 
        return $this->belongsTo('App\User');
    }

}
