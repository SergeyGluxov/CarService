<?php
namespace App\Services;

use App\Repositories\SchedulesRepository;
use Illuminate\Http\Request;

class SchedulesService
{
    protected $schedulesRepository;
    public function __construct(SchedulesRepository $schedulesRepository)
    {
        $this->schedulesRepository=$schedulesRepository;
    }

    public function all()
    {
        return $this->schedulesRepository->all();
    }
    public function store(Request $request)
    {
        return $this->schedulesRepository->store($request);
    }
}
