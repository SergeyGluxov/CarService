<?php

namespace App\Exports;


use App\Appointment;
use App\Http\Resources\AppointmentExportResource;
use App\Http\Resources\AppointmentResource;
use Maatwebsite\Excel\Concerns\FromCollection;

class AppointmentsExport implements FromCollection
{
    public function collection()
    {
        AppointmentExportResource::withoutWrapping();
        return AppointmentExportResource::collection(Appointment::all());
    }
}
