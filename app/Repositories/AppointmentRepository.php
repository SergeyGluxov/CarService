<?php

namespace App\Repositories;

use App\Appointment;
use App\Http\Requests\Api\StoreAppointmentRequest;
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
    public function paginate()
    {
        $appoint = Appointment::paginate(3);
        return $appoint;
    }
    public function find($id)
    {
        AppointmentResource::withoutWrapping();
        return new AppointmentResource(Appointment::find($id));
    }
    public function store(StoreAppointmentRequest $request){
        $appoint = new Appointment();
        $appoint->user_id       = auth('api')->user()->getAuthIdentifier(); //Добавить id пользователя, который добавляет
        $appoint->type_service  = $request->get('type_service');
        $appoint->description   = $request->get('description');
        $appoint->save();
        return response('Запись успешно добалена', 200);
    }
}