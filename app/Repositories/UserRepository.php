<?php

namespace App\Repositories;

use App\Appointment;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\UserResource;
use App\User;

class UserRepository
{
    /**
     * Получить все записи на осмотр заданного пользователя.
     * @param User $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function all()
    {
        UserResource::withoutWrapping();
        return UserResource::collection(User::all());
    }
    public function find($id)
    {
        UserResource::withoutWrapping();
        return new UserResource(User::find($id));
    }
}