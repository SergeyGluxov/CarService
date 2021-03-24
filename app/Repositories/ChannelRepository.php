<?php

namespace App\Repositories;

use App\Category;
use App\ChannelsSource;
use App\Filters\ChannelFilters;
use App\Http\Resources\ChannelCollection;
use App\Source;
use GuzzleHttp\Client;
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

    public function paginate(Request $request)
    {
        $count = $request->get('count');
        $cursor = $request->get('cursor');
        $channel = Channel::where('id', '>=', $cursor)->paginate($count);
        dd($channel);
        ChannelCollection::withoutWrapping();
        return new ChannelCollection($channel);
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
        $channelItem->category_id = $request->get('category_id');
        $channelItem->save();
        return response('Телеканал успешно добавлен', 200);
    }

    public function update(Request $request, $id)
    {
        $channelUpdate = Channel::find($id);
        $channelUpdate->title = $request->get('title');
        $channelUpdate->logo = $request->get('logo');
        $channelUpdate->lang = $request->get('lang');
        $category_id = Category::where('title','=',$request->get('category_id'))->get();
        $channelUpdate->category_id = $category_id[0]->id;
        $channelUpdate->save();
        return response('Телеканал обновлен', 200);
    }

    public function destroy($id)
    {
        $channelDestroy = Channel::findOrFail($id);
        if ($channelDestroy->delete())
            return response('Телеканал успешно удален!', 200);
    }


    public function getFilterChannels(ChannelFilters $filters)
    {
        $channels = Channel::filter($filters)->get();
        ChannelCollection::withoutWrapping();
        return new ChannelCollection($channels);
    }

    public function getChannelsByCategory(Request $request)
    {
        $param = $request->get('category_name');
        $channels = Channel::whereHas('category', function ($query) use ($param) {
            $query->where('title', '=', $param);
        })->get();
        ChannelCollection::withoutWrapping();
        return new ChannelCollection($channels);
    }


    public function getChannelFromGitHub()
    {
        $urlPlayListArray = null;

        $client = new Client();
        $response = $client->get('https://vagonott.github.io/iptv/channels.json');
        $jsonFormattedResult = json_decode($response->getBody()->getContents(), true);
        $categories = Category::all();
        foreach ($jsonFormattedResult as $item) {
            $title = $item['name'];
            $logo = $item['logo'];
            $category_id = 1;

            //Распределение по категориям(те которые у нас уже определены)
            foreach ($categories as $category) {
                if ($item['category'] == $category->getAttribute('title')) {
                    $category_id = $category->getAttribute('id');
                } else {
                    $category_id = 666;
                }
            }

            $lang = $item['languages'][0]['code'];
            if ($logo == null) {
                $logo = "Нет";
            }
            if ($lang == null) {
                $lang = "Нет";
            }

            if ($title == null) {
                $title = "Нет";
            }
            $channelItem = new Channel();
            $channelItem->title = $title;
            $channelItem->logo = $logo;
            $channelItem->lang = $lang;
            $channelItem->category_id = $category_id;
            $channelItem->save();

            //Сохранить ресурс
            $sourcesItem = new Source();
            $sourcesItem->url = $item['url'];
            $sourcesItem->save();

            //Найти ID текущего канала
            $searchChannelID = Channel::where('title', '=', $title)->get();
            $searchSourceID = Source::where('url', '=', $item['url'])->get();

            //Сохранить каналу ресурс
            $channelSource = new ChannelsSource();
            $channelSource->channel_id = $searchChannelID[0]->id;
            $channelSource->source_id = $searchSourceID[0]->id;
            $channelSource->save();
        }
        return redirect('/home');
    }
}
