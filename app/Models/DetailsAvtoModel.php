<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailsAvtoModel extends Model
{
    public function detail() {
        return $this->belongsTo('App\Models\Detail', 'detail_id', 'id');
    }

    public function avto_model() {
        return $this->belongsTo('App\Models\AvtoModel', 'avto_model_id', 'id');
    }
}
