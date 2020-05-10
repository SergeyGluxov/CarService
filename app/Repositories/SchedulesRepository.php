<?php

namespace App\Repositories;

use App\Http\Resources\SchedulesResource;
use Illuminate\Http\Request;
use App\Schedules;

class SchedulesRepository
{
    protected $schedules;

    public function __construct(Schedules $schedules)
    {
        $this->schedules = $schedules;
    }

    public function all()
    {
        SchedulesResource::withoutWrapping();
        return SchedulesResource::collection(Schedules::all());
    }

    public function store(Request $request)
    {
        $schedules = new Schedules();
        $schedules->user_id = $request->get('user_id');
        $schedules->appointment_id = $request->get('appointment_id');
        $schedules->save();
        return response('Запись успешно добалена в рассписание', 200);
    }

    public function find($id)
    {
        SchedulesResource::withoutWrapping();
        return new SchedulesResource(Schedules::where('id', $id)->firstOrFail());
    }
}
