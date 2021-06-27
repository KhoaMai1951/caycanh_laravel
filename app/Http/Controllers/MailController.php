<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendVerificationEmail($activationToken, $email){
        $details = [
            'title' => 'Mail from Don\'t Leaf Me app',
            'body' => 'Before you can login to our app, you must enter verification code: ' . $activationToken,
        ];

   //     \Mail::to('chronicle1951@gmail.com')->send(new \App\Mail\MailNotify($details));
        Mail::to($email)->send(new \App\Mail\MailNotify($details));
    }
}
