<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    //defines relation b/w user and gender is gender belongs to many users
    public function users(){
        return $this->hasMany('App\User');
    }
}
