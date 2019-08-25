<?php

namespace App\Repositories;

use App\Appointment;
use App\Http\Resources\AppointmentResource;
use App\Http\Resources\UserResource;
use App\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

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