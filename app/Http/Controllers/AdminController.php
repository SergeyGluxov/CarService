<?php

namespace App\Http\Controllers;
use App;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //Получить всех пользователей
    public function getUsers()
    {
        $users = User::all();
        //dd($users);
        return view('admin_layouts/users_settings', compact('users'));
    }
}
