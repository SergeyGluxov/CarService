<?php

namespace App\Repositories;
use App\Http\Resources\StackResource;
use App\Models\Stack;
use Illuminate\Http\Request;

class StackRepository
{
    protected $stack;

    public function __construct(Stack $stack)
    {
        $this->stack = $stack;
    }

    public function all()
    {
        StackResource::withoutWrapping();
        return StackResource::collection(Stack::all());
    }


    public function find($id)
    {
        StackResource::withoutWrapping();
        return new StackResource(Stack::find($id));
    }

    public function store(Request $request)
    {
        $stackStore = new Stack();
        $stackStore->stock_id = $request->get('stock_id');
        $stackStore->save();
        return response('Стеллаж успешно добавлен', 200);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $stackDestroy = Stack::findOrFail($id);
        if ($stackDestroy->delete())
            return response('Стеллаж успешно удален!', 200);
    }
}
