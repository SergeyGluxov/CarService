<?php

namespace App\Repositories;
use App\Http\Resources\FactoryResource;
use App\Models\Factory;
use Illuminate\Http\Request;

class FactoryRepository
{
    protected $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function all()
    {
        FactoryResource::withoutWrapping();
        return FactoryResource::collection(Factory::all());
    }


    public function find($id)
    {
        FactoryResource::withoutWrapping();
        return new FactoryResource(Factory::find($id));
    }

    public function store(Request $request)
    {
        $factoryStore = new Factory();
        $factoryStore->title = $request->get('title');
        $factoryStore->save();
        return response('Завод успешно добавлен', 200);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $factoryDestroy = Factory::findOrFail($id);
        if ($factoryDestroy->delete())
            return response('Завод успешно удален!', 200);
    }
}
