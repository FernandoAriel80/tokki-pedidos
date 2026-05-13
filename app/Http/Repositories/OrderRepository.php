<?php

namespace App\Http\Repositories;

use App\Models\Order;

class OrderRepository
{

    public function all($userId, $limit)
    {
        return Order::where('user_id', $userId)->orderByDesc('created_at')->paginate($limit);
    }

    public function allSearch($userID, $search, $limit, $isFinished = null)
    {
        $query = Order::where('user_id', $userID)
            ->where(function ($q) use ($search) {
                $q->where('product_title', 'like', '%' . $search . '%')
                    ->orWhere('customer_name', 'like', '%' . $search . '%');
            });

        // Aplicar filtro de estado solo si se especifica
        if ($isFinished !== null) {
            $query->where('is_finished', $isFinished);
        }

        return $query->paginate($limit)->appends(['search' => $search]);
    }
    public function getById($id, $userID)
    {
        return Order::where('id', $id)->where('user_id', $userID)->first();
    }
    public function create($data)
    {
        return Order::create($data);
    }

    public function update($id, $data)
    {
        return Order::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Order::where('id', $id)->delete();
    }
}
