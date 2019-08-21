<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Http\Requests\Api\AppointmentRequest;
use App\Repositories\AppointmentRepository;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $appointments;

    public function __construct(AppointmentRepository $appointments)
    {
        $this->appointments=$appointments;
    }

    public function index()
    {
        return $this->appointments->all();
    }

    public function create()
    {
        //
    }

    public function store(AppointmentRequest $request)
    {
        return $this->appointments->store($request);
    }

    public function show($id)
    {
        return $this->appointments->find($id);
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
