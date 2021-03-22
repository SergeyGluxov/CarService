<?php

namespace App\Repositories;
use App\ChannelsSource;
use App\Http\Resources\SourcesResource;
use App\Source;
use Illuminate\Http\Request;

class ChannelSourceRepository
{
    protected $source;

    public function __construct(ChannelsSource $source)
    {
        $this->source = $source;
    }

    public function all()
    {
        SourcesResource::withoutWrapping();
        return SourcesResource::collection(ChannelsSource::all());
    }


    public function find($id)
    {
        SourcesResource::withoutWrapping();
        return new SourcesResource(ChannelsSource::find($id));
    }



    public function store(Request $request,$sourceId)
    {
        $sourcesItem = new ChannelsSource();
        $sourcesItem->source_id = $sourceId;
        $sourcesItem->channel_id = $request->get('channel_id');
        $sourcesItem->save();
        return response('Новый плейлист добавлен', 200);
    }

    public function destroy($id)
    {
        $sourcesItem = ChannelsSource::findOrFail($id);
        if ($sourcesItem->delete())
            return response('Плейлист успешно удален!', 200);
    }
}
