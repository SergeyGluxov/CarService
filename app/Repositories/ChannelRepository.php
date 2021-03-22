<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use App\Http\Resources\ChannelResource;
use App\Channel;

class ChannelRepository
{
    protected $channel;

    public function __construct(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function all()
    {
        ChannelResource::withoutWrapping();
        return ChannelResource::collection(Channel::all());
    }


    public function find($id)
    {
        ChannelResource::withoutWrapping();
        return new ChannelResource(Channel::find($id));
    }

    public function store(Request $request)
    {
        $channelItem = new Channel();
        $channelItem->title = $request->get('title');
        $channelItem->logo = $request->get('logo');
        $channelItem->lang = $request->get('lang');
        $channelItem->save();
        return response('Телеканал успешно добавлен', 200);
    }

    public function update(Request $request, $id)
    {
        $channelUpdate = Channel::find($id);
        $channelUpdate->title = $request->get('title');
        $channelUpdate->logo = $request->get('logo');
        $channelUpdate->lang = $request->get('lang');
        $channelUpdate->save();
        return response('Телеканал обновлен', 200);
    }

    public function destroy($id)
    {
        $channelDestroy = Channel::findOrFail($id);
        if ($channelDestroy->delete())
            return response('Телеканал успешно удален!', 200);
    }
}
