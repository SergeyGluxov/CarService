<?php

namespace App\Http\Controllers;

use App\User;
use App\Appointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'type_service' => 'required|max:255',
            'users_id' => 'required|max:255'
        ]);

        $appoint = new Appointment;

        $appoint->type_service = $request->type_service;
        $appoint->users_id = $request->users_id;
        $appoint->save();

    }
}
