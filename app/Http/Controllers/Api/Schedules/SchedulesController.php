<?php

namespace App\Http\Controllers\Api\Schedules;

use App\Http\Controllers\Controller;
use App\Schedules;
use App\Services\SchedulesService;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    protected $schedulesService;
    public function __construct(SchedulesService $schedulesService)
    {
        $this->schedulesService=$schedulesService;
    }

    public function index()
    {
        return $this->schedulesService->all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->schedulesService->store($request);
    }

    public function show($id)
    {
        return $this->schedulesService->find($id);
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
        //
    }
}
