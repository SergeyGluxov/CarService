<?php

namespace App\Http\Controllers\Api\TypeDetail;


use App\Http\Controllers\Controller;
use App\Repositories\TypeDetailRepository;
use Illuminate\Http\Request;

class TypeDetailController extends Controller
{
    protected $typeDetailRepository;

    public function __construct(TypeDetailRepository $typeDetailRepository)
    {
        $this->typeDetailRepository = $typeDetailRepository;
    }

    public function index()
    {
        return $this->typeDetailRepository->all();
    }

    public function show($id)
    {
        return $this->typeDetailRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->typeDetailRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->typeDetailRepository->destroy($id);
    }
}
