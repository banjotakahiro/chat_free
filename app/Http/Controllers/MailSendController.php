<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailSendController extends Controller
{
    public function send(){
        $data = [];
        Mail::send('emails.test', $data, function($message){
        $message->to('watawata20220404@gmail.com', 'Test')
                ->subject('This is a test mail');
    });
    }
}
