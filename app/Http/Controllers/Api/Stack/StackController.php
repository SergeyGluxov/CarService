<?php

namespace App\Http\Controllers\Api\Stack;


use App\Http\Controllers\Controller;
use App\Repositories\StackRepository;
use Illuminate\Http\Request;

class StackController extends Controller
{
    protected $stackRepository;

    public function __construct(StackRepository $stackRepository)
    {
        $this->stackRepository = $stackRepository;
    }

    public function index()
    {
        return $this->stackRepository->all();
    }

    public function show($id)
    {
        return $this->stackRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->stackRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->stackRepository->destroy($id);
    }
}
