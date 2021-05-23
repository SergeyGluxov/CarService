<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => new RolesResource($this->roles()->firstOrFail()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
