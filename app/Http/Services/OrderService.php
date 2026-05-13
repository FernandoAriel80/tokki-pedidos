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

    public function getOrderById($id)
    {
        $userID = Auth::id();
        $order = $this->orderRepository->getById($id, $userID);
        if (!$order) throw new Exception("Error al obtener el usuario");
        return $order;
    }

    public function getAllOrdersPagination()
    {
        $id = Auth::id();
        $orders = $this->orderRepository->all($id, $this->limit);
        if (!$orders) throw new Exception('Error al obtener los pedidos.');

        return $orders;
    }

    public function fetAllOrdersPaginationBySearch($search)
    {
        $id = Auth::id();
        $orders = $this->orderRepository->allSearch($id, $search, $this->limit);
        if (!$orders) throw new Exception('Error al obtener los pedidos.');

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
        if (!$order) throw new Exception('error al crear usuario');
        return $order;
    }

    public function updateOrder($id, $data)
    {
        $userID = Auth::id();
        $result = $this->orderRepository->getById($id, $userID);
        if (!$result) throw new Exception('error al encontrar pedido');

        $finished_date_value =  array_key_exists('finished_data', $data) ? $data['finished_data'] : null;
        $payload = [
            'product_title' => $data['title'],
            'customer_name' => $data['customer'],
            'price' => (float) $data['price'],
            'description' => $data['description'],
            'delivery_date' => $data['delivery_date'],
            'is_finished' => array_key_exists('is_finished', $data) ? 1 : 0,
            'finished_date' => array_key_exists('is_finished', $data)
                ? now()->toDateString()
                : $finished_date_value
        ];

        $order = $this->orderRepository->update($id, $payload);
        if (!$order) throw new Exception('error al actualziar pedido');

        return $order;
    }

    public function deleteOrder($id)
    {
        $userID = Auth::id();

        $result = $this->orderRepository->getById($id, $userID);
        if (!$result) throw new Exception('error al econtrar el pedido');

        $order = $this->orderRepository->delete($id);
        if (!$order) throw new Exception('error al eliminar pedido');

        return $order;
    }
}
