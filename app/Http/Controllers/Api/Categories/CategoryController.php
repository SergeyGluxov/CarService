<?php

namespace App\Http\Controllers\Api\Categories;


use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return $this->categoryRepository->all();
    }

    public function show($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->categoryRepository->store($request);
    }


    //Удаление запись
    public function destroy($id)
    {
        return $this->categoryRepository->destroy($id);
    }
}
