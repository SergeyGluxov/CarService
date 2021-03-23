<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class Channel extends Model
{
    public function scopeFilter(Builder $builder, QueryFilter $filters)
    {
        return $filters->apply($builder);
    }

    public function sources()
    {
        return $this->belongsToMany('App\Source', 'channels_sources', 'channel_id', 'source_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
