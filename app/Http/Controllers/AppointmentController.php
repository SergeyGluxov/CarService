<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * CRUD-контроллер для управления записями на осмотр/ремонт
     **/
    public function index()
    {
        return Appointment::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $appoint = new Appointment();
        $appoint->user_id       = $request->get('user_id');
        $appoint->type_service  = $request->get('type_service');
        $appoint->description   = $request->get('description');
        $appoint->save();
        return response('Запись успешно добалена', 200);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
