<?php

namespace App\Repositories;

use App\Appointment;
use App\Http\Requests\Api\AppointmentRequest;
use App\Http\Resources\AppointmentResource;

class AppointmentRepository
{
    /**
     * Получить все записи на осмотр заданного пользователя.

     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function all()
    {
        AppointmentResource::withoutWrapping();
        return AppointmentResource::collection(Appointment::all());
    }
    public function find($id)
    {
        AppointmentResource::withoutWrapping();
        return new AppointmentResource(Appointment::find($id));
    }
    public function store(AppointmentRequest $request){
        $appoint = new Appointment();
        $appoint->user_id       = auth('api')->user()->getAuthIdentifier(); //Добавить id пользователя, который добавляет
        $appoint->type_service  = $request->get('type_service');
        $appoint->description   = $request->get('description');
        $appoint->save();
        return response('Запись успешно добалена', 200);
    }
}