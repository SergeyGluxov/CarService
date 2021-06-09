<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'power' => $this->power,
            'engine_value' => $this->engine_value,
            'year' => $this->year,
            'model' => new AvtoModelResource($this->avto_model('title')->firstOrFail()),
        ];
    }
}
