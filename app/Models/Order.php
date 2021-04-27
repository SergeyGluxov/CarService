<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function detail() {
        return $this->belongsTo('App\Models\Detail', 'detail_id', 'id');
    }

    public function supplier() {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'id');
    }
}
