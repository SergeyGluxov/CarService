<?php

namespace App\Http\Controllers\Api\Details;


use App\Http\Controllers\Controller;
use App\Repositories\DetailRepository;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    protected $detailRepository;

    public function __construct(DetailRepository $detailRepository)
    {
        $this->detailRepository = $detailRepository;
    }

    public function index()
    {
        return $this->detailRepository->all();
    }

    public function show($id)
    {
        return $this->detailRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->detailRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->detailRepository->destroy($id);
    }
}
