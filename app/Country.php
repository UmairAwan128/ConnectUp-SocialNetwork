<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    //defines relation b/w user and country is country belongs to many users
    public function users(){
        return $this->hasMany('App\User');
    }

}
