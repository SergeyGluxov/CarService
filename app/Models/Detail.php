<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    public function type_detail()
    {
        return $this->belongsTo(TypeDetails::class);
    }

    public function avto_model()
    {
        return $this->belongsToMany('App\Models\AvtoModel', 'details_avto_models', 'detail_id', 'avto_model_id');
    }
}
