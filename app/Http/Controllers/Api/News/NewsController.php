<?php

namespace App\Http\Controllers\Api\News;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsResource;
use App\News;
use App\Sto;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index()
    {
        NewsResource::withoutWrapping();
        return NewsResource::collection(News::all());
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
