<?php

namespace App\Repositories;

use App\Http\Resources\SourcesResource;
use App\Source;
use Illuminate\Http\Request;

class SourceRepository
{
    protected $source;

    public function __construct(Source $source)
    {
        $this->source = $source;
    }

    public function all()
    {
        SourcesResource::withoutWrapping();
        return SourcesResource::collection(Source::all());
    }

    public function getLast()
    {
        return Source::all()->count();
    }

    public function find($id)
    {
        SourcesResource::withoutWrapping();
        return new SourcesResource(Source::find($id));
    }

    public function store(Request $request)
    {
        $sourcesItem = new Source();
        $sourcesItem->url = $request->get('url');
        $sourcesItem->save();
        return response('Новый плейлист добавлен', 200);
    }


    public function destroy($id)
    {
        $sourcesItem = Source::findOrFail($id);
        if ($sourcesItem->delete())
            return response('Плейлист успешно удален!', 200);
    }
}
