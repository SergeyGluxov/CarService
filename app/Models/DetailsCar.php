<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailsCar extends Model
{
    public function detail() {
        return $this->belongsTo('App\Models\Detail', 'detail_id', 'id');
    }

    public function car() {
        return $this->belongsTo('App\Models\Car', 'car_id', 'id');
    }
}
