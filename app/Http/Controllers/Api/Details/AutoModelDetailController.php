<?php

namespace App\Http\Controllers\Api\Details;


use App\Http\Controllers\Controller;
use App\Repositories\AutoModelDetailRepository;
use Illuminate\Http\Request;

class AutoModelDetailController extends Controller
{
    protected $autoModelDetailRepository;

    public function __construct(AutoModelDetailRepository $autoModelDetailRepository)
    {
        $this->autoModelDetailRepository = $autoModelDetailRepository;
    }

    public function index()
    {
        return $this->autoModelDetailRepository->all();
    }

    public function show($id)
    {
        return $this->autoModelDetailRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->autoModelDetailRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->autoModelDetailRepository->destroy($id);
    }
}
