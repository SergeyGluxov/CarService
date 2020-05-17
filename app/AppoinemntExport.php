<?php


namespace App;
use Maatwebsite\Excel\Concerns\FromCollection;

class AppoinemntExport implements FromCollection
{
    public function collection()
    {
        return Appointment::all();
    }
}
