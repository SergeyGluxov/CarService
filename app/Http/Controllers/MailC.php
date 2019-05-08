<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

class MailC extends Controller
{
    public function send()
    {
       Mail::send(['text' => 'mail'], ['name', 'CarService'], function ($message){
           $message->to('pmalchukov@mail.ru', 'user')->subject('Успешная регистрация!');
           $message->from('pmalchukov@mail.ru', 'CarService');
       });
    }
}
