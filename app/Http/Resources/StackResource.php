<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StackResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'stock_id' => $this->stock_id
        ];
    }
}
