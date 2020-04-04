<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
