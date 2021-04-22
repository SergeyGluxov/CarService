<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailAvtoModelResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cost' => $this->cost,
            'avto_model' => new AvtoModelResource($this->avto_model()->firstOrFail()),
            'detail' => new DetailResource($this->detail()->firstOrFail())
        ];
    }
}
