<?php

namespace App\Http\Controllers\Api\Sto;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoResource;
use App\Sto;
use Illuminate\Http\Request;

class StoController extends Controller
{
    public function index()
    {
        StoResource::withoutWrapping();
        return StoResource::collection(Sto::all());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
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
