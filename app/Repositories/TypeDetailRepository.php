<?php

namespace App\Repositories;
use App\Http\Resources\TypeDetailResource;
use App\Models\TypeDetails;
use Illuminate\Http\Request;

class TypeDetailRepository
{
    protected $typeDetail;

    public function __construct(TypeDetails $typeDetail)
    {
        $this->typeDetail = $typeDetail;
    }

    public function all()
    {
        TypeDetailResource::withoutWrapping();
        return TypeDetailResource::collection(TypeDetails::all());
    }


    public function find($id)
    {

        TypeDetailResource::withoutWrapping();
        return new TypeDetailResource(TypeDetails::find($id));
    }

    public function store(Request $request)
    {
        $typeDetailStore = new TypeDetails();
        $typeDetailStore->title = $request->get('title');
        $typeDetailStore->save();
        return response('Тип детали успешно добавлен', 200);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $typeDetailDestroy = TypeDetails::findOrFail($id);
        if ($typeDetailDestroy->delete())
            return response('Тип детали успешно удалена!', 200);
    }
}
