<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'title' => $this->title,
            'display_name' => $this->display_name,
            'logo' => $this->logo
        ];
    }
}
