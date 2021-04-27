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

    public function index()
    {
        return $this->orderRepository->all();
    }

    public function show($id)
    {
        return $this->orderRepository->find($id);
    }

    public function store(Request $request)
    {
        return $this->orderRepository->store($request);
    }

    public function destroy($id)
    {
        return $this->orderRepository->destroy($id);
    }
}
