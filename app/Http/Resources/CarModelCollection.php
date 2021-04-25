<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CarModelCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $grades = array();
        foreach ($this->resource as $grade) {
            $grades[] = array(
                'id' => $grade->id,
                'power' => $grade->power,
                'engine_value' => $grade->engine_value
            );
        }
        return $grades;
    }
}
