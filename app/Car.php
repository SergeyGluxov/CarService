<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected  $fillable = ['brand'];
    public  function  users()
    {
        return $this->hasMany(User::class);
    }
}
