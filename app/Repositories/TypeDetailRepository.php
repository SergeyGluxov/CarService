<?php

namespace App\Repositories;
use App\Http\Resources\TypeDetailResource;
use App\Models\TypeDetail;
use Illuminate\Http\Request;

class TypeDetailRepository
{
    protected $typeDetail;

    public function __construct(TypeDetail $typeDetail)
    {
        $this->typeDetail = $typeDetail;
    }

    public function all()
    {
        dump(TypeDetail::all());

        TypeDetailResource::withoutWrapping();
        return TypeDetailResource::collection(TypeDetail::all());
    }


    public function find($id)
    {

        TypeDetailResource::withoutWrapping();
        return new TypeDetailResource(TypeDetail::find($id));
    }

    public function store(Request $request)
    {
        $typeDetailStore = new TypeDetail();
        $typeDetailStore->title = $request->get('title');
        $typeDetailStore->save();
        return response('Тип детали успешно добавлен', 200);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $typeDetailDestroy = TypeDetail::findOrFail($id);
        if ($typeDetailDestroy->delete())
            return response('Тип детали успешно удалена!', 200);
    }
}
