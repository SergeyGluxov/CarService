<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{

    public function channels()
    {
        return $this->belongsToMany('App\Channel', 'channels_sources', 'channel_id', 'source_id');
    }

}
