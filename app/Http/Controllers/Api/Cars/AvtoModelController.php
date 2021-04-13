<?php

namespace App\Http\Controllers\Api\Cars;


use App\Http\Controllers\Controller;
use App\Repositories\AvtoModelRepository;
use Illuminate\Http\Request;

class AvtoModelController extends Controller
{
    protected $avtoModelRepository;

    public function __construct(AvtoModelRepository $avtoModelRepository)
    {
        $this->avtoModelRepository = $avtoModelRepository;
    }

    public function index()
    {
        return $this->avtoModelRepository->all();
    }

    public function show($id)
    {
        return $this->avtoModelRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->avtoModelRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->avtoModelRepository->destroy($id);
    }
}
