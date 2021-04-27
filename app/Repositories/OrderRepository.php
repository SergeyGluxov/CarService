<?php

namespace App\Repositories;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderRepository
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function all()
    {
        OrderResource::withoutWrapping();
        return OrderResource::collection(Order::all());
    }


    public function find($id)
    {
        OrderResource::withoutWrapping();
        return new OrderResource(Order::find($id));
    }

    public function store(Request $request)
    {
        $orderStore = new Order();
        $orderStore->status = $request->get('status');
        $orderStore->detail_id = $request->get('detail_id');
        $orderStore->supplier_id = $request->get('supplier_id');
        $orderStore->count = $request->get('count');
        $orderStore->save();
        return response('Заявка поставщику успешно создана', 200);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $orderDestroy = Order::findOrFail($id);
        if ($orderDestroy->delete())
            return response('Заявка поставщику успешно удалена!', 200);
    }
}
