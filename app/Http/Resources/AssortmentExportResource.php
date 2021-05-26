<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AssortmentExportResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cost' => $this->cost,
            'car_id' => (new CarResource($this->car()->firstOrFail()))->id,
            'detail_id' => (new DetailResource($this->detail()->firstOrFail()))->id,
        ];
    }
}
