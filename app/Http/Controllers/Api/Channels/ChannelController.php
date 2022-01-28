<?php

namespace App\Http\Controllers\Api\Channels;


use App\Filters\ChannelFilters;
use App\Http\Controllers\Controller;
use App\Repositories\ChannelRepository;
use App\Repositories\ChannelSourceRepository;
use App\Repositories\SourceRepository;
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

    public function paginate(Request $request)
    {
        return $this->channelRepository->paginate($request);
    }

    public function show($id)
    {
        return $this->channelRepository->find($id);
    }

    //Сохранить запись новую клиента
    public function store(Request $request)
    {
        return $this->channelRepository->store($request);
    }

    public function update(Request $request, $id)
    {
        return $this->channelRepository->update($request, $id);
    }

    //Удаление запись
    public function destroy($id)
    {
        return $this->channelRepository->destroy($id);
    }

    public function getFilterChannels(ChannelFilters  $filters)
    {
        return $this->channelRepository->getFilterChannels($filters);
    }

    public function getChannelsByCategory(Request $request)
    {
        return $this->channelRepository->getChannelsByCategory($request);
    }

    public function filterByArrayName(Request $request)
    {
        return $this->channelRepository->filterByArrayName($request);
    }


    //Синхронизировать со списком GitHub
    public function getChannelFromGitHub()
    {
        return $this->channelRepository->getChannelFromGitHub();

    }
}
