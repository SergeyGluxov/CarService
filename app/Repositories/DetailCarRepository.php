<?php

namespace App\Repositories;

use App\Http\Resources\AssortmentFilterCollection;
use App\Http\Resources\DetailCarResource;
use App\Http\Resources\DetailResource;
use App\Models\Detail;
use App\Models\DetailsCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function getDetailCarByType(Request $request)
    {
        $detailTest = DetailsCar::all();

        $detailFilterType = [];
        foreach ($detailTest as $item) {
            $detail = Detail::where('id', '=', $item->detail()->first()->id)->get();
            if ($detail[0]->type_detail()->first()->id == $request->get('type_detail_id')) {
                array_push($detailFilterType, $item);
            }
        }
        $detailFilterCar = [];
        foreach ($detailFilterType as $item) {
            if ($item->car_id == $request->get('car_id')) {
                array_push($detailFilterCar, $item);
            }
        }
        $testArray = [];
        $test[] = array();
        foreach ($detailFilterCar as $item){
            $test = array(
                "id" => $item->id,
                "cost" => $item->cost,
                "detail" => $item->detail()->first(),
                "car" => $item->car()->first(),
            );
            array_push($testArray, $test);
        }
        return response()->json($testArray);
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
