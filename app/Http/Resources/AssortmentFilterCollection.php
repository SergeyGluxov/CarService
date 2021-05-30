<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AssortmentFilterCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $grades = array();
        foreach ($this->resource as $grade) {
            $grades[] = array(
                'id' => $grade->id
            );
        }
        return $grades;
    }
}
