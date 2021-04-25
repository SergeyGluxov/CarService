<?php

namespace App\Repositories;
use App\Http\Resources\DetailCarResource;
use App\Http\Resources\DetailResource;
use App\Models\Detail;
use App\Models\DetailsCar;
use Illuminate\Http\Request;

class DetailCarRepository
{
    protected $detailCar;

    public function __construct(DetailsCar $detailCar)
    {
        $this->detailCar = $detailCar;
    }

    public function all()
    {
        DetailCarResource::withoutWrapping();
        return DetailCarResource::collection(DetailsCar::all());
    }


    public function find($id)
    {
        DetailCarResource::withoutWrapping();
        return new DetailCarResource(DetailsCar::find($id));
    }

    public function store(Request $request)
    {
        $detailCarStore = new DetailsCar();
        $detailCarStore->detail_id = $request->get('detail_id');
        $detailCarStore->car_id = $request->get('car_id');
        $detailCarStore->cost = $request->get('cost');
        $detailCarStore->save();
        return response('Товар успешно добавлен', 200);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $detailCarDestroy = DetailsCar::findOrFail($id);
        if ($detailCarDestroy->delete())
            return response('Товар успешно удалена!', 200);
    }
}
