<?php


namespace App\Filters;


class ChannelFilters extends QueryFilter
{
    public function is_top($isTop)
    {
        return $this->builder->where('is_top', '=', $isTop);
    }

    public function lang($lang)
    {
        return $this->builder->where('lang','=', $lang);
    }

}
