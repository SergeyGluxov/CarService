<?php

namespace App\Services;

use App\Repositories\RolesRepository;
use App\Repositories\ServicesRepository;
use Illuminate\Http\Request;

class ServicesService
{
    protected $servicesRepository;

    public function __construct(ServicesRepository $servicesRepository)
    {
        $this->servicesRepository = $servicesRepository;
    }

    public function all()
    {
        return $this->servicesRepository->all();
    }

    public function store(Request $request)
    {
        return $this->servicesRepository->store($request);
    }


    public function destroy($id)
    {
        return $this->servicesRepository->destroy($id);
    }

    public function findByType(Request $request)
    {
        return $this->servicesRepository->findByType($request);
    }
}
