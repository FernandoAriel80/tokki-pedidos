<?php

namespace App\Http\Repositories;

use App\Models\Order;

class OrderRepository
{

    public function all($userId, $limit)
    {
        return Order::where('user_id', $userId)->orderByDesc('created_at')->simplePaginate($limit);
    }

    public function allSearch($search, $limit, $isFinished = null)
    {
        return Order::where('product_title', 'like', '%' . $search . '%')
            ->orWhere('customer_name', 'like', '%' . $search . '%')
            ->orWhere('is_finished', $isFinished)
            ->paginate($limit)
            ->appends(['search' => $search]);
    }

    public function getById($id)
    {
        return Order::find($id);
    }
    public function create($data)
    {
        return Order::create($data);
    }
}
