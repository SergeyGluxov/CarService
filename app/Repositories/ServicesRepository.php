<?php

namespace App\Repositories;

use App\Http\Resources\ServicesResource;
use App\Service;
use Illuminate\Http\Request;

class ServicesRepository
{
    public function all()
    {
        ServicesResource::withoutWrapping();
        return ServicesResource::collection(Service::all());
    }

    public function find($id)
    {
        ServicesResource::withoutWrapping();
        return new ServicesResource(Service::find($id));
    }

    public function findByType(Request $request)
    {
        $services = Service::where('type', $request->get('type'))->firstOrFail();
        ServicesResource::withoutWrapping();
        return new ServicesResource($services);
    }

    public function store(Request $request)
    {
        $service = new Service();
        $service->title = $request->get('title');
        $service->cost = $request->get('cost');
        $service->duration = $request->get('duration');
        $service->type = $request->get('type');
        $service->save();
        return response('Услуга успешно добалена', 200);
    }

    public function destroy($id)
    {
        $servicesDestroy = Service::findOrFail($id);
        if ($servicesDestroy->delete())
            return response('Услуга успешно удалена!', 200);
    }
}
