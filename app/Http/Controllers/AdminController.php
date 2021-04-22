<?php

namespace App\Http\Controllers;

use App;
use App\Appointment;
use App\Exports\AppointmentsExport;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //----------------------------------АВТОМОБИЛИ----------------------------------------------------------------------
    public function getAuto()
    {
        return view('admin_layouts/auto/all');
    }

    public function getAutoModel()
    {
        return view('admin_layouts/auto/model');
    }

    public function getAutoBrand()
    {
        return view('admin_layouts/auto/brand');
    }

    public function getTypeDetail()
    {
        return view('admin_layouts/details/type_details');
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
        return view('admin_layouts/channels');
    }

    public function getTopChannels()
    {
        return view('admin_layouts/top_channels');
    }

    public function getEmployee()
    {
        return view('admin_layouts/employee/all');
    }

    //---------------------------Экспорт----------------------------------------------

    public function getExportUser()
    {
        return Excel::download(new UsersExport, 'Пользователи.xlsx');
    }

    public function getExport()
    {
        return Excel::download(new AppointmentsExport, 'Заявки.xlsx');
    }

    //---------------------------Импорт----------------------------------------------
    public function importUsers(Request $request)
    {
        $path1 = $request->file('excelUploadUsers')->store('/');
        $file = storage_path('app') . '/' . $path1;

        Excel::import(new UsersImport, $file);
        return back();
    }

    public function importAppointments(Request $request)
    {
        $path1 = $request->file('excelUpload')->store('/');
        $file = storage_path('app') . '/' . $path1;

        Excel::import(new App\Imports\AppointmentsImport, $file);
        return back();
    }

    public function index()
    {
        return App\Http\Resources\UsersResourse::collection();
    }
}
