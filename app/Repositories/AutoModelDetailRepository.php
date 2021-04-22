<?php

namespace App\Repositories;
use App\Http\Resources\DetailAvtoModelResource;
use App\Http\Resources\DetailResource;
use App\Models\Detail;
use App\Models\DetailsAvtoModel;
use Illuminate\Http\Request;

class AutoModelDetailRepository
{
    protected $detailAvtoModel;

    public function __construct(DetailsAvtoModel $detailAvtoModel)
    {
        $this->detailAvtoModel = $detailAvtoModel;
    }

    public function all()
    {
        DetailAvtoModelResource::withoutWrapping();
        return DetailAvtoModelResource::collection(DetailsAvtoModel::all());
    }


    public function find($id)
    {
        DetailAvtoModelResource::withoutWrapping();
        return new DetailAvtoModelResource(DetailsAvtoModel::find($id));
    }

    public function store(Request $request)
    {
        $detailAvtoModelStore = new DetailsAvtoModel();
        $detailAvtoModelStore->detail_id = $request->get('detail');
        $detailAvtoModelStore->avto_model_id = $request->get('avto_model');
        $detailAvtoModelStore->cost = $request->get('cost');
        $detailAvtoModelStore->save();
        return response('Товар успешно добавлен', 200);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $detailAvtoModeDestroy = DetailsAvtoModel::findOrFail($id);
        if ($detailAvtoModeDestroy->delete())
            return response('Деталь успешно удалена!', 200);
    }
}
