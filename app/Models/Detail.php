<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    public function type_detail()
    {
        return $this->belongsTo(TypeDetails::class);
    }
}
