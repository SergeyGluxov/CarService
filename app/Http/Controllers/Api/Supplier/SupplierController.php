<?php

namespace App\Http\Controllers\Api\Supplier;


use App\Http\Controllers\Controller;
use App\Repositories\SupplierRepository;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $supplierRepository;
    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository=$supplierRepository;
    }

    public function index(Request $request)
    {
        return $this->supplierRepository->all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->supplierRepository->store($request);

    }

    public function show($id)
    {
        return $this->supplierRepository->find($id);
    }

    public function edit($id)
        {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        return $this->supplierRepository->destroy($id);
    }
}
