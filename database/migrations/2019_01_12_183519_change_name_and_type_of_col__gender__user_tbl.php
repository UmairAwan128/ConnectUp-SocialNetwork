<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNameAndTypeOfColGenderUserTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table){
         
              // before php artisan migrate
              // first add the dependency, as __->change() method will not work so just
              //run     composer require doctrine/dbal
              //now run      php artisan migrate
              //for details check this 
             //https://laravel.com/docs/5.0/schema#changing-columns 
         
             
             $table->renameColumn('country_id', 'country');
             $table->renameColumn('gender_id', 'gender'); 
             $table->string('country')->change();
             $table->string('gender')->change();
         
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
