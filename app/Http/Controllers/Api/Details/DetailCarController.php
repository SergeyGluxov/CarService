<?php

namespace App\Http\Controllers\Api\Details;


use App\Exports\AppointmentsExport;
use App\Exports\AssortmentExport;
use App\Http\Controllers\Controller;
use App\Imports\AssortmentImport;
use App\Repositories\DetailCarRepository;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DetailCarController extends Controller
{
    protected $detailCarRepository;

    public function __construct(DetailCarRepository $detailCarRepository)
    {
        $this->detailCarRepository = $detailCarRepository;
    }

    public function index()
    {
        return $this->detailCarRepository->all();
    }

    public function show($id)
    {
        return $this->detailCarRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->detailCarRepository->store($request);
    }


    public function getDetailCarByType(Request $request)
    {
        return $this->detailCarRepository->getDetailCarByType($request);
    }

    public function destroy($id)
    {
        return $this->detailCarRepository->destroy($id);
    }


    public function export()
    {
        return Excel::download(new AssortmentExport(), 'Ассортимент_автозапчастей.xlsx');
    }

    public function import(Request $request)
    {
        $path1 = $request->file('excelUploadAssortment')->store('/');
        $file = storage_path('app') . '/' . $path1;

        Excel::import(new AssortmentImport(), $file);
        return back();
    }
}
