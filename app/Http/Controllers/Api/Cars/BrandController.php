<?php

namespace App\Http\Controllers\Api\Cars;


use App\Http\Controllers\Controller;
use App\Repositories\BrandRepository;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function index()
    {
        return $this->brandRepository->all();
    }

    public function show($id)
    {
        return $this->brandRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->brandRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->brandRepository->destroy($id);
    }
}
