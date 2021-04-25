<?php

namespace App\Repositories;
use App\Http\Resources\CarModelCollection;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Request;

class CarRepository
{
    protected $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function all()
    {
        CarResource::withoutWrapping();
        return CarResource::collection(Car::all());
    }


    public function find($id)
    {
        CarResource::withoutWrapping();
        return new CarResource(Car::find($id));
    }

    public function store(Request $request)
    {
        $carStore = new Car();
        $carStore->avto_model_id = $request->get('model');
        $carStore->engine_value = $request->get('engine_value');
        $carStore->power = $request->get('power');
        $carStore->save();
        return response('Автомобиль успешно добавлен', 200);
    }


    public function getCarsByModels(Request $request)
    {
        $param = $request->get('model_id');
        $models = Car::whereHas('avto_model', function ($query) use ($param) {
            $query->where('avto_model_id', '=', $param);
        })->get();

        CarModelCollection::withoutWrapping();
        return new CarModelCollection($models);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $carDestroy = Car::findOrFail($id);
        if ($carDestroy->delete())
            return response('Автомобиль успешно удалена!', 200);
    }
}
