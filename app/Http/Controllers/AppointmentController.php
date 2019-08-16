<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Http\Requests\Api\AppointmentRequest;
use App\Repositories\AppointmentRepository;
use App\Http\Resources\AppointmentResource;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $appointments;

    public function __construct(AppointmentRepository $appointments)
    {
        $this->appointments=$appointments;
    }

    /**
     * CRUD-контроллер для управления записями на осмотр/ремонт
     **/
    public function index(Request $request)
    {
        return $this->appointments->all($request->user());
    }

    public function create()
    {
        //
    }

    /**
     * @param AppointmentRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request)
    {
        $appoint = new Appointment();
        $appoint->user_id       = auth('api')->user()->getAuthIdentifier(); //Добавить id пользователя, который добавляет
        $appoint->type_service  = $request->get('type_service');
        $appoint->description   = $request->get('description');
        $appoint->save();
        return response('Запись успешно добалена', 200);
    }

    public function show($id)
    {
        AppointmentResource::withoutWrapping();
        return new AppointmentResource(Appointment::find($id));
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
