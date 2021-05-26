<?php

namespace App\Exports;


use App\Http\Resources\AssortmentExportResource;
use App\Models\DetailsCar;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Http\Resources\DetailCarResource;

class AssortmentExport implements FromCollection
{
    public function collection()
    {
        AssortmentExportResource::withoutWrapping();
        return AssortmentExportResource::collection(new DetailCarResource(DetailsCar::all()));
    }
}
