<?php

namespace App\Http\Controllers\Api\Cars;


use App\Http\Controllers\Controller;
use App\Repositories\AvtoModelRepository;
use App\Repositories\CarRepository;
use Illuminate\Http\Request;

class CarController extends Controller
{
    protected $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    public function index()
    {
        return $this->carRepository->all();
    }

    public function show($id)
    {
        return $this->carRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->carRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->carRepository->destroy($id);
    }
}
