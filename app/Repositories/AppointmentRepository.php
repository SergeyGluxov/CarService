<?php

namespace App\Repositories;

use App\Appointment;
use App\Http\Requests\Api\StoreAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    public function findByTypeID($service_id)
    {
        $appointment = Appointment::where('service_id', $service_id)->firstOrFail();
        AppointmentResource::withoutWrapping();
        return new AppointmentResource($appointment);
    }

    public function store(StoreAppointmentRequest $request)
    {
        $appoint = new Appointment();
        $appoint->user_id = auth('api')->user()->getAuthIdentifier(); //Добавить id пользователя, который добавляет
        $appoint->service_id = $request->get('service_id');
        $appoint->type_service = $request->get('type_service');
        $appoint->description = $request->get('description');
        $appoint->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $appoint->save();
        return response('Запись успешно добалена', 200);
    }

    public function storeAdmin(StoreAppointmentRequest $request)
    {
        $appointment = new Appointment();
        $appointment->user_id = $request->get('user_id');
        $appointment->service_id = $request->get('service_id');
        $appointment->type_service = $request->get('type_service');
        $appointment->description = $request->get('description');
        $appointment->save();
        return response('Запись успешно добалена', 200);
    }

    public function changeStatusAdmin(Request $request)
    {
        $services = Appointment::where('id', $request->get('id'))->firstOrFail();
        if ($services->status === "Новая") {
            $services->status = "В работе";
            $services->update();
        } else if ($services->status === "В работе") {
            $services->status = "Выполнена";
            $services->update();
        } else {
            return response('Статус - максимум', 666);
        }
        return response('Статус успешно изменен', 200);
    }

    public function destroy($id)
    {
        $appointmentDestroy = Appointment::findOrFail($id);
        if ($appointmentDestroy->delete())
            return response('Заявка успешно удалена!', 200);
    }
}
