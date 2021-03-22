<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function sources()
    {
        return $this->belongsToMany('App\Source', 'channels_sources', 'channel_id', 'source_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
