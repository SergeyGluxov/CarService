<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function avto_model()
    {
        return $this->belongsTo(AvtoModel::class);
    }
}
