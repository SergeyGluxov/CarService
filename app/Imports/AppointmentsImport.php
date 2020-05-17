<?php

namespace App\Imports;

use App\Appoinement;
use App\Appointment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class AppointmentsImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        /*$appointment = new Appointment();
            $appointment->user_id = $request->get('user_id');
            $appointment->service_id = $request->get('service_id');
            $appointment->type_service = $request->get('type_service');
            $appointment->description = $request->get('description');
            $appointment->created_at = $request->get('created_at');
            $appointment->save();*/

        foreach ($collection as $row) {

            $appointment = new Appointment();
            $appointment->user_id = $row[1];
            $appointment->service_id = $row[2];
            $appointment->type_service = $row[3];
            $appointment->description = $row[4];
            $appointment->created_at = $row[5];
            $appointment->updated_at = $row[6];
            $appointment->status = 'Новая';
            $appointment->save();
        }
    }
}
