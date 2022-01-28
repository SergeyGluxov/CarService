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
        $channel = Channel::orderBy('position', 'ASC')->get();

        ChannelResource::withoutWrapping();
        return ChannelResource::collection($channel);
    }

    public function paginate(Request $request)
    {
        $count = $request->get('count');
        $cursor = $request->get('cursor');
        $channel = Channel::where('id', '>=', $cursor)->paginate($count);
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
        $category_id = Category::where('title', '=', $request->get('category_id'))->get();
        $channelItem->category_id = $category_id[0]->id;
        $channelItem->position = $this->getLastRussianChannel() + 1;
        $channelItem->save();
        return response('Телеканал успешно добавлен', 200);
    }

    public function update(Request $request, $id)
    {
        $channelUpdate = Channel::find($id);
        $channelUpdate->title = $request->get('title');
        $channelUpdate->logo = $request->get('logo');
        $channelUpdate->lang = $request->get('lang');

        //Ищем текущую позицию телеканала
        $currentPosition = Channel::where('title', '=', $request->get('title'))->get()[0]->position;

        //Обновить канал со схожей позицией(задать ему позицию текущего канала)
        $channelForChange = Channel::where('position', '=', $request->get('position'))->get();
        if ($channelForChange->count() > 0) {
            $channelForChange[0]->position = $currentPosition;
            $channelForChange[0]->save();
        }

        //Позиция свободна для канала, зададим ее
        $channelUpdate->position = $request->get('position');

        $category_id = Category::where('title', '=', $request->get('category_id'))->get();
        dump($request->get('category_id'));
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
        })->orderBy('position', 'ASC')->get();
        ChannelCollection::withoutWrapping();
        return new ChannelCollection($channels);
    }


    public function filterByArrayName(Request $request)
    {
        $param = $request->get('titles');
        $response = array();

        foreach (Channel::all() as $channel) {
            if (in_array($channel['title'], $param)) {
                array_push($response, $channel);
            }
        }

        ChannelCollection::withoutWrapping();
        return new ChannelCollection(collect($response));


    }


    public function getChannelFromGitHub()
    {
        $urlPlayListArray = null;

        $client = new Client();
        $response = $client->get('https://vagonott.github.io/iptv/channelsRusSchedule.json');
        $jsonFormattedResult = json_decode($response->getBody()->getContents(), true);
        $categories = Category::all();
        $rusPosSort = 0;
        foreach ($jsonFormattedResult as $item) {
            $title = $item['name'];
            $logo = $item['logo'];

            //Распределение по категориям(те которые у нас уже определены)
            $category_id = $this->getCategoryId($item['category']);
            $category_id = 1;
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
            $channelItem->position = $rusPosSort;
            $rusPosSort += 1;

            $channelItem->lang = $lang;
            $channelItem->category_id = $category_id;
            $channelItem->save();

            //Сохранить ресурс
            $sourcesItem = new Source();
            $sourcesItem->url = $item['playlist'][0];
            $sourcesItem->save();

            //Найти ID текущего канала
            $searchChannelID = Channel::where('title', '=', $title)->get();
            $searchSourceID = Source::where('url', '=', $item['playlist'][0])->get();

            //Сохранить каналу ресурс
            $channelSource = new ChannelsSource();
            $channelSource->channel_id = $searchChannelID[0]->id;
            $channelSource->source_id = $searchSourceID[0]->id;
            $channelSource->save();
        }
        return redirect('/home');
    }

    private function getCategoryId($value)
    {
        $categoryId = 0;
        $allCategories = Category::all();
        foreach ($allCategories as $category) {
            if ($value == $category->title) {
                $categoryId = $category->getAttribute('id');
                break;
            } else {
                $categoryId = 666;
            }
        }
        return $categoryId;
    }

    public function getLastRussianChannel()
    {
        $maxId = Channel::max('position');
        return $maxId;
    }

}
