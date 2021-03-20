<?php

namespace App\Http\Controllers\Api\Sources;


use App\Http\Controllers\Controller;
use App\Repositories\ChannelRepository;
use App\Repositories\SourceRepository;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    protected $sourceRepository;

    public function __construct(SourceRepository $sourceRepository)
    {
        $this->sourceRepository = $sourceRepository;
    }

    public function index()
    {
        return $this->sourceRepository->all();
    }

    public function store(Request $request)
    {
        return $this->sourceRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->sourceRepository->destroy($id);
    }
}
