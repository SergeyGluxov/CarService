<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company' => $this->company,
            'address' => $this->address,
            'phone' => $this->phone,
            'email' => $this->email
        ];
    }
}
