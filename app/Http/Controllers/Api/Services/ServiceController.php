<?php

namespace App\Http\Controllers\Api\Services;

use App\Http\Controllers\Controller;
use App\Services\ServicesService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $servicesService;

    public function __construct(ServicesService $servicesService)
    {
        $this->servicesService = $servicesService;
    }

    public function index()
    {
        return $this->servicesService->all();
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        return $this->servicesService->store($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    //Поиск по ID услуги
    public function findByType(Request $request)
    {
        return $this->servicesService->findByType($request);
    }

    public function destroy($id)
    {
        return $this->servicesService->destroy($id);
    }
}
