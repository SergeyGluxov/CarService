<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'detail' => new DetailResource($this->detail()->firstOrFail()),
            'supplier' => new SupplierResource($this->supplier()->firstOrFail()),
            'count' => $this->count
        ];
    }
}
