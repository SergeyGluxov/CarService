<?php

namespace App\Http\Controllers\Api\Details;


use App\Http\Controllers\Controller;
use App\Repositories\DetailCarRepository;
use Illuminate\Http\Request;

class DetailCarController extends Controller
{
    protected $detailCarRepository;

    public function __construct(DetailCarRepository $detailCarRepository)
    {
        $this->detailCarRepository = $detailCarRepository;
    }

    public function index()
    {
        return $this->detailCarRepository->all();
    }

    public function show($id)
    {
        return $this->detailCarRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->detailCarRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->detailCarRepository->destroy($id);
    }
}
