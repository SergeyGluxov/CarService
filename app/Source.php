<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    public function channels()
    {
        return $this->belongsTo(Channel::class);
    }

}
