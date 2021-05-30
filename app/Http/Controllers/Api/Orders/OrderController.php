<?php

namespace App\Http\Controllers\Api\Orders;
use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    //получить все заказы
    public function index()
    {
        return $this->orderRepository->all();
    }

    //найти определенный заказ по его ID
    public function show($id)
    {
        return $this->orderRepository->find($id);
    }

    //создать новый заказ
    public function store(Request $request)
    {
        return $this->orderRepository->store($request);
    }

    public function update(Request $request)
    {
        return $this->orderRepository->update($request);
    }

    //удалить заказ по его ID
    public function destroy($id)
    {
        return $this->orderRepository->destroy($id);
    }
}
