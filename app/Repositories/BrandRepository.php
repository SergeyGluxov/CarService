<?php

namespace App\Repositories;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandRepository
{
    protected $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public function all()
    {
        BrandResource::withoutWrapping();
        return BrandResource::collection(Brand::all());
    }


    public function find($id)
    {
        BrandResource::withoutWrapping();
        return new BrandResource(Brand::find($id));
    }

    public function store(Request $request)
    {
        $brandStore = new Brand();
        $brandStore->title = $request->get('title');
        $brandStore->save();
        return response('Бренд успешно добавлен', 200);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $brandDestroy = Brand::findOrFail($id);
        if ($brandDestroy->delete())
            return response('Бренд успешно удалена!', 200);
    }
}
