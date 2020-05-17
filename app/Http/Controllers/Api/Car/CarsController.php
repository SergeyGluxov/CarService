<?php

namespace App\Http\Controllers\Api\Car;

use App\Car;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarsController extends Controller
{

    public function index()
    {
        return Car::all();
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $car = new Car();
        $car->brand = $request->get('brand');
        $car->model = $request->get('model');
        $car->state_number = $request->get('state_number');
        $car->type_car_id = $request->get('type_car_id');
        $car->save();
        return response('Автомобиль создан', 200);
    }

    public function findByMark(Request $request)
    {
        return Car::where('model', $request->get('model'))->firstOrFail();
    }

    public function show($id)
    {
        return Car::find($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
