<?php

namespace App\Repositories;
use App\Http\Resources\AvtoModelResource;
use App\Models\AvtoModel;
use Illuminate\Http\Request;

class AvtoModelRepository
{
    protected $avtoModel;

    public function __construct(AvtoModel $avtoModel)
    {
        $this->$avtoModel = $avtoModel;
    }

    public function all()
    {
        AvtoModelResource::withoutWrapping();
        return AvtoModelResource::collection(AvtoModel::all());
    }


    public function find($id)
    {
        AvtoModelResource::withoutWrapping();
        return new AvtoModelResource(AvtoModel::find($id));
    }

    public function store(Request $request)
    {
        $avtoModel = new AvtoModel();
        $avtoModel->brand_id = $request->get('brand');
        $avtoModel->title = $request->get('title');
        $avtoModel->save();
        return response('Модель авто успешно добавлен', 200);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $avtoModelDestroy = AvtoModel::findOrFail($id);
        if ($avtoModelDestroy->delete())
            return response('Модель авто успешно удалена!', 200);
    }
}
