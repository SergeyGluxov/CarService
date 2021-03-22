<?php

namespace App\Repositories;
use App\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function all()
    {
        CategoryResource::withoutWrapping();
        return CategoryResource::collection(Category::all());
    }


    public function find($id)
    {
        CategoryResource::withoutWrapping();
        return new CategoryResource(Category::find($id));
    }

    public function store(Request $request)
    {
        $categoryStore = new Category();
        $categoryStore->title = $request->get('title');
        $categoryStore->save();
        return response('Категория упешно добавлена', 200);
    }

    public function update(Request $request, $id)
    {
        $categoryUpdate = Category::find($id);
        $categoryUpdate->title = $request->get('title');
        $categoryUpdate->save();
        return response('Категория обновлена', 200);
    }

    public function destroy($id)
    {
        $categoryDestroy = Category::findOrFail($id);
        if ($categoryDestroy->delete())
            return response('Категория успешно удалена!', 200);
    }
}
