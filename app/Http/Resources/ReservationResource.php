<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'goods' => new DetailCarResource($this->detail()->firstOrFail()),
            'user' => new UserResource($this->user()->firstOrFail()),
            'count' => $this->count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
