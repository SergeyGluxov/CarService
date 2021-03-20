<?php

namespace App\Http\Controllers\Api\Channels;


use App\Http\Controllers\Controller;
use App\Repositories\ChannelRepository;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    protected $channelRepository;

    public function __construct(ChannelRepository $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }

    //Показать все записи клиентов
    public function index()
    {
        return $this->channelRepository->all();
    }

    //Сохранить запись новую клиента
    public function store(Request $request)
    {
        return $this->channelRepository->store($request);
    }

    //Удаление запись
    public function destroy($id)
    {
        return $this->channelRepository->destroy($id);
    }
}
