<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//will create all data/api routes for the PostsController
//i.e all posts get/set/put/delete routes and will be auto mapped
//to their respective methods in the Posts controller
//we don,t need to do that to see there url and methodType(get,post) use
// php artisan route:list    in cmd/bash
Route::resource('posts','PostsController');
//e.g  (each route is unique on the basis of url+method)
//  Method   URL                 Loc
//   POST   | posts             | App\Http\Controllers\PostsController@store
//   GET    | posts             | App\Http\Controllers\PostsController@index
//  GET     | posts/create      | App\Http\Controllers\PostsController@create
//  GET     | posts/{post}       | App\Http\Controllers\PostsController@show
// GET      | posts/{post}/edit   | App\Http\Controllers\PostsController@edit
// PUT|PATCH | posts/{post}      | App\Http\Controllers\PostsController@update
//  DELETE    | posts/{post}     | App\Http\Controllers\PostsController@destroy


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')
->name('home');
//->middleware('verified');
Route::get('/homeContent', 'HomeController@indexAjax');

Route::get('/FindFriends', 'UsersController@index');

Route::get('/usersNextPage', 'UsersController@getUsersPagination');
Route::get('/searchUsers', 'UsersController@searchUser');


Route::get('/searchPosts', 'PostsController@searchPosts');
Route::get('/searchPostsNextPage', 'PostsController@searchPostsNextPage');



//middleware('verified') so before going to home page now first verify view will be shown which
// will ask user to check its email and click link there to folow to home page
//and verify the email. 

//to change the design of the email content send to the user e.g change
// button style or add some toher things make changes in this file
//ConnectUp/vendor/laravel/framework/src/illuminate/Auth/Notification/VerifyEmail.php
//make changes in its toMail($notifiable){} method
//its template file is this if you need to change it
//ConnectUp/vendor/laravel/framework/src/illuminate/Notifications/resources/views/email.blade.php


Route::get('/Profile', 'ProfilesController@indexs');
Route::post('/UpdateCover', 'ProfilesController@update_cover');
Route::post('/UpdateProfile', 'ProfilesController@update_profilePic');
Route::get('/userPosts', 'ProfilesController@getCurrentUsersPost');
Route::get('/editUserProfile', 'ProfilesController@editUserProfile');
Route::post('/updateUserInformation', 'ProfilesController@updateUserInformation');

Route::post('/Shared/UploadImage', 'sharedController@uploadImage');

Route::get('/Messages/index', 'MessagesController@index');
Route::get('/Messages/allUsersSidePane', 'MessagesController@allUsersSidePane');
Route::get('/Messages/getbyUser', 'MessagesController@getChatPaneByUser');
Route::post('/Messages/create', 'MessagesController@createMessage');

