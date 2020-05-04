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

    //----------------------------------ПОЛЬЗОВАТЕЛИ--------------------------------------------------------------------

    public function getUsers()
    {
        return view('admin_layouts/users/all');
    }

    public function createUser()
    {
        return view('admin_layouts/users/create');
    }

    public function deleteUser()
    {
        return view('admin_layouts/users/delete');
    }

    //----------------------------------РАСПИСАНИЕ РАБОТ----------------------------------------------------------------

    public function getSchedules()
    {
        return view('admin_layouts/schedules');
    }

    //----------------------------------РАСПИСАНИЕ РАБОТ----------------------------------------------------------------
    public function getServices()
    {
        return view('admin_layouts/services/all');
    }

    //----------------------------------РАСПИСАНИЕ РАБОТ----------------------------------------------------------------

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
        return view('admin_layouts/checkup_settings');
    }

    public function index()
    {
        return App\Http\Resources\UsersResourse::collection();
    }
}
