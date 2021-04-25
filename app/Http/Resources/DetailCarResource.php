<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailCarResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cost' => $this->cost,
            'car' => new CarResource($this->car()->firstOrFail()),
            'detail' => new DetailResource($this->detail()->firstOrFail())
        ];
    }
}
