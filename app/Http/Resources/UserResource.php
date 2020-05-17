<?php

namespace App\Http\Resources;

use App\Car;
use App\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_at' => $this->updated_at,
            'role' => User::where('id', $this->id)->firstOrFail()->roles()->where('user_id', $this->id)->get(),
            'cars' => Car::where('id', $this->cars_id)->firstOrFail()
        ];
    }
}
