<?php

namespace App\Http\Controllers\Api\Stock;


use App\Http\Controllers\Controller;
use App\Repositories\DetailRepository;
use App\Repositories\StockRepository;
use Illuminate\Http\Request;

class StockController extends Controller
{
    protected $stockRepository;

    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function index()
    {
        return $this->stockRepository->all();
    }

    public function show($id)
    {
        return $this->stockRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->stockRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->stockRepository->destroy($id);
    }
}
