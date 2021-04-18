<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AvtoModelsCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $grades = array();
        foreach ($this->resource as $grade) {
            $grades[] = array(
                'id' => $grade->id,
                'title' => $grade->title,
                'brand' => new BrandResource($grade->brand('title')->firstOrFail())
            );
        }
        return $grades;
    }
}
