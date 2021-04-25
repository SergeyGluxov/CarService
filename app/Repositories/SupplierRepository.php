<?php

namespace App\Repositories;

use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierRepository
{
    protected $supplier;

    public function __construct(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function all()
    {
        SupplierResource::withoutWrapping();
        return SupplierResource::collection(Supplier::all());
    }

    public function getWorkers()
    {
        $workers = Supplier::whereHas(
            'roles', function ($q) {
            $q->where('name', '!=', null);
        }
        )->get();
        SupplierResource::withoutWrapping();
        return SupplierResource::collection($workers);
    }


    public function find($id)
    {
        SupplierResource::withoutWrapping();
        return new SupplierResource(SupplierResource::where('id', $id)->firstOrFail());
    }

    public function store(Request $request)
    {
        $supplierStore = new Supplier();
        $supplierStore->company = $request->get('company');
        $supplierStore->address = $request->get('address');
        $supplierStore->phone = $request->get('phone');
        $supplierStore->email = $request->get('email');
        $supplierStore->save();
        return response('Поставщик успешно добавлен!', 200);
    }

    public function destroy($id)
    {
        $supplierDestory = Supplier::findOrFail($id);
        if ($supplierDestory->delete())
            return response('Поставщик удален!', 200);
    }
}
