<?php

namespace App\Repositories;

use App\Appointment;
use App\Http\Resources\AppointmentResource;
use App\User;

class AppointmentRepository
{
    /**
     * Получить все записи на осмотр заданного пользователя.
     * @param User $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function all(User $user)
    {
        AppointmentResource::withoutWrapping();
        return AppointmentResource::collection(Appointment::all());
    }
}