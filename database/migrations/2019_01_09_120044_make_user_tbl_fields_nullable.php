<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeUserTblFieldsNullable extends Migration
{
    //this migration is to add a field to existing table
    //to create file
    //php artisan make:migration AddCoverImageToPosts
    //after adding field code
    //run    php artisan migrate
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table){
              //php artisan make:migration AddUserIdToPosts
               // before php artisan migrate
              // first add the dependency, as __->change() method will not work so just
              //run     composer require doctrine/dbal
              //now run      php artisan migrate
              //for details check this 
             //https://laravel.com/docs/5.0/schema#changing-columns 
  
            $table->string('about', 500)->nullable()->change();
            $table->string('Relationship')->nullable()->change();
            $table->string('status')->nullable()->change();
           
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
