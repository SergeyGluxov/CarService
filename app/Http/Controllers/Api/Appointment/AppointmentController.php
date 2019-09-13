<?php

namespace App\Http\Controllers\Api\Appointment;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAppointmentRequest;
use App\Repositories\AppointmentRepository;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $appointments;

    public function __construct(AppointmentRepository $appointments)
    {
        $this->appointments=$appointments;
    }
    //Показать все записи на осмотр
    public function index()
    {
        return $this->appointments->paginate();
    }
    public function paginate()
    {
        return $this->appointments->paginate();
    }
    //Сохранить запись на осмотр
    public function store(StoreAppointmentRequest $request)
    {
        return $this->appointments->store($request);
    }
    //Показать подробности записи
    public function show($id)
    {
        return $this->appointments->find($id);
    }

    public function create()
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

    public function destroy($id)
    {
        //
    }
}
