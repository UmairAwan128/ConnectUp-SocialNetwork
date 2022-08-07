<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //defines relation b/w gender and user
    //user can have only one gender 
    public function user(){
        //belongTo tell single obj not many
        //telling here the name of the model to which its relation with  
        return $this->belongsTo('App\User');
    }
    
}
