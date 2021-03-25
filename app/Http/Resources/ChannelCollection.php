<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ChannelCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $grades = array();
        foreach ($this->resource as $grade) {
            $grades[] = array(
                'id' => $grade->id,
                'position' => $grade->position,
                'category' => new CategoryResource($grade->category('category_id')->firstOrFail()),
                'title' => $grade->title,
                'logo' => $grade->logo,
                'lang' => $grade->lang,
                'playlists' => SourcesResource::collection($grade->sources)
            );
        }
        return $grades;
    }
}
