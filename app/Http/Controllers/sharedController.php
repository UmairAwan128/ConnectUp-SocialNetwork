<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class sharedController extends Controller{

    function uploadImage(Request $request){
        // dd($name);

        if($_FILES["file"]["name"] != '')
        {
    
            $test = explode('.', $_FILES["file"]["name"]);
            $ext = end($test);
            $name = rand(100, 999) . '.' . $ext;
            //on client side while ajax in formdata we passed image and
            //assigned it name i.e "file" so we accessed file/image with "file"
            $image = $request->file('file');  
            // move_uploaded_file($_FILES["file"]["tmp_name"], $location);
            // echo '<img src="'.$location.'" height="150" width="225" class="img-thumbnail" />';
             //move images to the images folder in the Public folder
             $image->move(public_path('images'), $name);
             return response()->json([
             'message'   => 'Looking Good? (@_@?), Or Try another ',
             'uploaded_image_dest' => '/images/'.$name,
             'class_name'  => 'alert-success'
             ]);
        }
        
        else
        {
                return response()->json([
                'message'   => $validation->errors()->all(),
                'uploaded_image_dest' => '',
                'class_name'  => 'alert-danger'
                ]);
        }

    }

}
?>