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
        return view('admin_layouts/users_settings');
    }

    public function getSchedules()
    {
        return view('admin_layouts/schedules');
    }

    public function stroreEmployee()
    {
        return view('admin_layouts/add_employee');
    }

    public function removeEmployee()
    {
        return view('admin_layouts/remove_employee');
    }

    public function addRole()
    {
        return view('admin_layouts/add_role');
    }

    public function removeRole()
    {
        return view('admin_layouts/remove_role');
    }

    public function searchMaster()
    {
        return view('admin_layouts/search_master');
    }

    public function getCheckup()
    {
        /*//Пример составления join's запросов
        $appoint = Appointment::with('users')
            ->join('users', 'users.id', '=', 'appointments.user_id')
            ->get(['users.name', 'appointments.description', 'appointments.created_at']);*/
        return view('admin_layouts/checkup_settings');
    }
    public  function index()
    {
      return App\Http\Resources\UsersResourse::collection();
    }
}
