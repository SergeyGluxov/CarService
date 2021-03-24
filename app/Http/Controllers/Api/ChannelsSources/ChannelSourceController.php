<?php

namespace App\Http\Controllers\Api\ChannelsSources;


use App\Http\Controllers\Controller;
use App\Repositories\ChannelSourceRepository;
use App\Repositories\SourceRepository;
use Illuminate\Http\Request;

class ChannelSourceController extends Controller
{
    protected $channelRepository;
    protected $sourceRepository;

    public function __construct(ChannelSourceRepository $channelRepository, SourceRepository $sourceRepository)
    {
        $this->channelRepository = $channelRepository;
        $this->sourceRepository = $sourceRepository;
    }

    //Показать все записи клиентов
    public function index()
    {
        return $this->channelRepository->all();
    }

    public function show($id)
    {
        return $this->channelRepository->find($id);
    }

    //Сохранить запись новую клиента
    public function store(Request $request)
    {
        //Сохранить сначала в таблицу плейлистов
       $this -> sourceRepository->store($request);
       $sourceId = $this->sourceRepository->getLast();

        return $this->channelRepository->store($request,$sourceId);
    }

    public function update(Request $request, $id)
    {
        return $this->channelRepository->update($request, $id);
    }

    //Удаление запись
    public function destroy($id)
    {
        return $this->sourceRepository->destroy($id);
    }
}
