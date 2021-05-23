<?php

namespace App\Http\Controllers;

use App\MailMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMessage(Request $request)
    {
        $to_name = 'Sergey';
        $to_email = 'gluxov14@gmail.com';
        $data = array('name'=>"Sam Jose", "body" => "Test mail");
        Mail::send('emails', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Artisans Web Testing Mail');
            $message->from('sendler.goodflix@gmail.com','Artisans Web');
        });
        return response('Телеканал успешно добавлен', 200);
    }
}
