<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function sources()
    {
        return $this->hasMany(Source::class);
    }
}
