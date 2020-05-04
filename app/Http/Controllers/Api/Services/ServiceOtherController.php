<?php

namespace App\Http\Controllers\Api\Services;

use App\Http\Controllers\Controller;
use App\Services\ServicesService;
use Illuminate\Http\Request;

class ServiceOtherController extends Controller
{
    protected $servicesService;

    public function __construct(ServicesService $servicesService)
    {
        $this->servicesService = $servicesService;
    }

    public function findByType($type)
    {
        return $this->servicesService->findByType($type);
    }

}
