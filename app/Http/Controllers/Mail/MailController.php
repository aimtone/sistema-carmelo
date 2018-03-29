<?php

namespace App\Http\Controllers;

use Mail as Mail;
use Illuminate\Http\Request;


class MailController extends Controller
{
    function sendMail(Request $request) {
        $mail_address = $request->input('mail');
        $subject = $request->input('subject');
        $title = $request->input('title');
        $content = $request->input('content');

        Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message)
        {
            $message->from('anthonyjmedinaf@gmail.com', 'Clienbot');
            $message->to($mail_address);
            $message->subject($subject);

        });

        return response()->json(['message' => 'Request completed']);
    }
}
