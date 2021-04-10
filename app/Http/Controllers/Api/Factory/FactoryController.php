<?php

namespace App\Http\Controllers\Api\Factory;


use App\Http\Controllers\Controller;
use App\Repositories\DetailRepository;
use App\Repositories\FactoryRepository;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    protected $factoryRepository;

    public function __construct(FactoryRepository $factoryRepository)
    {
        $this->factoryRepository = $factoryRepository;
    }

    public function index()
    {
        return $this->factoryRepository->all();
    }

    public function show($id)
    {
        return $this->factoryRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->factoryRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->factoryRepository->destroy($id);
    }
}
