<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    protected $fillable = array(
        'user_id',
        'service_id',
        'type_service',
        'description',
        'created_at',
        'updated_at',
        'status',
    );

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}



