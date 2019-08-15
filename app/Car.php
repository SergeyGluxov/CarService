<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public  function  user()
    {
        return $this->hasMany(User::class);
    }
}
