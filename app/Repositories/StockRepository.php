<?php

namespace App\Repositories;
use App\Http\Resources\StockResource;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockRepository
{
    protected $stock;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    public function all()
    {
        StockResource::withoutWrapping();
        return StockResource::collection(Stock::all());
    }


    public function find($id)
    {
        StockResource::withoutWrapping();
        return new StockResource(Stock::find($id));
    }

    public function store(Request $request)
    {
        $stockStore = new Stock();
        $stockStore->title = $request->get('title');
        $stockStore->save();
        return response('Склад успешно добавлен', 200);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $stockDestroy = Stock::findOrFail($id);
        if ($stockDestroy->delete())
            return response('Склад успешно удален!', 200);
    }
}
