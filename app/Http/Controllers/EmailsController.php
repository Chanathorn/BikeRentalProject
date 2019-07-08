<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class EmailsController extends Controller
{

    function post(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required',

        ]);
        $data=[
            'email'=>$request->email,
            'subject'=>$request->subject,
            'bodyMessage'=>$request->message,
        ];
         Mail::send('mail',$data,function($message) use($data) {
         $message->from('rlexchanathorn1996@gmail.com','maintenace');
         $message->to($data['email']);
         $message->subject($data['subject']);

     });
     return back()->with('success', 'Send E-mail Successfully');
    }
}