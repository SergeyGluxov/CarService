<?php

namespace App\Repositories;
use App\Http\Resources\DetailResource;
use App\Models\Detail;
use Illuminate\Http\Request;

class DetailRepository
{
    protected $detail;

    public function __construct(Detail $detail)
    {
        $this->detail = $detail;
    }

    public function all()
    {
        DetailResource::withoutWrapping();
        return DetailResource::collection(Detail::all());
    }


    public function find($id)
    {
        DetailResource::withoutWrapping();
        return new DetailResource(Detail::find($id));
    }

    public function store(Request $request)
    {
        $detailStore = new Detail();
        $detailStore->title = $request->get('title');
        $detailStore->weight = $request->get('weight');
        $detailStore->type_detail_id = $request->get('type_detail');
        $detailStore->save();
        return response('Деталь успешно добавлена', 200);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $detailDestroy = Detail::findOrFail($id);
        if ($detailDestroy->delete())
            return response('Деталь успешно удалена!', 200);
    }
}
