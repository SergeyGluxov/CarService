<?php

namespace App\Http\Resources;

use App\Models\TypeDetails;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'weight' => $this->weight,
            'type_detail' => new TypeDetailResource($this->type_detail()->firstOrFail())
        ];
    }
}
