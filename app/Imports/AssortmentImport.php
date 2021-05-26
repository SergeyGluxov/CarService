<?php

namespace App\Imports;

use App\Appoinement;
use App\Models\DetailsCar;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class AssortmentImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            $assortment = new DetailsCar();
            $assortment->cost = $row[1];
            $assortment->car_id = $row[2];
            $assortment->detail_id = $row[3];
            $assortment->save();
        }
    }
}
