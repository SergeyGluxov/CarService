<?php

namespace App\Repositories;

use App\Filters\ChannelFilters;
use App\Http\Resources\ChannelCollection;
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
        $channelUpdate->category_id = $request->get('category_id');
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
        dd($channels);
        ChannelCollection::withoutWrapping();
        return new ChannelCollection($channels);

/*        if($request->has('is_top') && $request->get('is_top') == true){
            $channels = Channel::where('is_top', '=', 1)->get();
        }else{
            ChannelResource::withoutWrapping();
            return ChannelResource::collection(Channel::all());
        }*/
    }



    public function getChannelFromGitHub()
    {
        $client = new Client();
        $response = $client->get('https://vagonott.github.io/iptv/channels.json');
        $jsonFormattedResult = json_decode($response->getBody()->getContents(), true);
        foreach($jsonFormattedResult as $item){
            $title = $item['name'];
            $logo = $item['logo'];
            //$category = $item['category'];
            //Найти название категории name = id
            $category_id = 1;
            $lang = $item['languages'][0]['code'];
            if($logo == null){
                $logo = "Нет";
            }
            if($lang == null){
                $lang = "Нет";
            }

            if($title == null){
                $title = "Нет";
            }
            if($lang == 'rus'){
                $channelItem = new Channel();
                $channelItem->title = $title;
                $channelItem->logo = $logo;
                $channelItem->lang = $lang;
                $channelItem->category_id = $category_id;
                $channelItem->save();
            }
        }

        return redirect('/home');
    }
}
