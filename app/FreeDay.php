<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class FreeDay
{
    public $time;
    public $isFree;

    public function __construct($time, $isFree)
    {
        $this->time = $time;
        $this->isFree = $isFree;
    }

}
