<?php
//to verify the email after register it will be off bydef to enable follow
//https://laravel.com/docs/5.7/verification
//then
//to change the design of the email content send to the user e.g change
// button style or add some toher things make changes in this file
//ConnectUp/vendor/laravel/framework/src/illuminate/Auth/Notification/VerifyEmail.php
//make changes in its toMail($notifiable){} method
//its template file is this if you need to change it
//ConnectUp/vendor/laravel/framework/src/illuminate/Notifications/resources/views/email.blade.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |   
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
}
