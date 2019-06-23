<?php

namespace App\Http\Controllers;

use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Car;
use App;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = App\User::find(Auth::user()->id);//Поиск в БД
        $cars = $users->cars;//Получение списка автомобилей у авторизованного пользователя
        $allcars = Car::all();
        return view('home', compact('cars', 'allcars'));
    }
    public  function s(Request $request)
    {
        $mark = $request->input('mark');
        echo $mark;
    }
}
