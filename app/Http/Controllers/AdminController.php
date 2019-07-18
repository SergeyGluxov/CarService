<?php

namespace App\Http\Controllers;
use App;
use App\Appointment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('admin_layouts/users_settings', compact('users'));
    }

    public function getCheckup()
    {
        //Пример составления join's запросов
        $appoint = Appointment::with('users')
            ->join('users', 'users.id', '=', 'appointments.user_id')
            ->get(['users.name', 'appointments.description', 'appointments.created_at']);
        return view('admin_layouts/checkup_settings', compact('appoint'));
    }

    public function getJson()
    {
        $users = User::all();
        return json_encode($users);
    }
}
