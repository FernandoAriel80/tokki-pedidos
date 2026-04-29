<?php

namespace App\Http\Services;

use App\Http\Repositories\OrderRepository;
use Exception;
use Illuminate\Support\Facades\Auth;

class OrderService
{

    private OrderRepository $orderRepository;
    private int $limit = 10;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
    }

    public function getOrderById($id) {
        $order = $this->orderRepository->getById($id);
        if (!$order) new Exception("Error al obtener el usuario");
        return $order;
    }

    public function getAllOrdersPagination()
    {
        $id = Auth::id();
        $orders = $this->orderRepository->all($id, $this->limit);
        if (!$orders) new Exception('Error al obtener los pedidos.');

        return $orders;
    }

    public function fetAllOrdersPaginationBySearch($search)
    {
        $orders = $this->orderRepository->allSearch($search, $this->limit);
        if (!$orders) new Exception('Error al obtener los pedidos.');

        return $orders;
    }
    public function createOrder($data, $id)
    {
        $payload = [
            'user_id' => $id,
            'product_title' => $data['title'],
            'customer_name' => $data['customer'],
            'price' => (float) $data['price'],
            'description' => $data['description'],
            //'is_finished'=>'',
            'delivery_date' => $data['delivery_date'],
            //'finished_date'=>'',
        ];

        $order = $this->orderRepository->create($payload);
        //var_dump($order);
        if (!$order) new Exception('error al crear usuario');
        return $order;
    }
}
