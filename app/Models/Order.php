<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('orders')]
#[Fillable(['user_id', 'product_title', 'customer_name', 'price', 'description', 'is_finished', 'delivery_date', 'finished_date'])]
class Order extends Model
{
    // app/Models/Order.php
    protected $casts = [
        'finished_date' => 'date:Y-m-d', // Solo fecha, sin timezone
        'delivery_date' => 'date:Y-m-d',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
