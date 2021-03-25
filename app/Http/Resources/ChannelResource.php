<?php

namespace App\Http\Resources;

use App\Source;
use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'position' => $this->position,
            'category' => new CategoryResource($this->category('category_id')->firstOrFail()),
            'title' => $this->title,
            'logo' => $this->logo,
            'lang' => $this->lang,
            'playlists' => SourcesResource::collection($this->sources)
        ];
    }
}
