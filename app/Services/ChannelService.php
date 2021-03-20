<?php

namespace App\Services;

use App\Repositories\ChannelRepository;
use Illuminate\Http\Request;

class ChannelService
{
    protected $channelRepository;

    public function __construct(ChannelRepository $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }

    public function all()
    {
        return $this->channelRepository->all();
    }

    public function find($id)
    {
        return $this->channelRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->channelRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->channelRepository->destroy($id);
    }
}
