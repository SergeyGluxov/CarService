<?php

namespace App\Services;

use App\Repositories\ChannelRepository;
use App\Repositories\SourceRepository;
use Illuminate\Http\Request;

class SourcesService
{
    protected $sourceRepository;

    public function __construct(SourceRepository $sourceRepository)
    {
        $this->sourceRepository = $sourceRepository;
    }

    public function all()
    {
        return $this->sourceRepository->all();
    }

    public function find($id)
    {
        return $this->sourceRepository->find($id);
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
