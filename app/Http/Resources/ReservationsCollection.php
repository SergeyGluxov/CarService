<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReservationsCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $grades = array();
        foreach ($this->resource as $grade) {
            $grades[] = array(
                'id' => $grade->id,
                'status' => $grade->status,
                'goods' => new DetailCarResource($grade->detail('details_car_id')->firstOrFail()),
                'user' => new UserResource($grade->user('user_id')->firstOrFail()),
                'count' => $grade->count,
                'created_at' => $grade->created_at,
                'updated_at' => $grade->updated_at

            );
        }
        return $grades;
    }
}
