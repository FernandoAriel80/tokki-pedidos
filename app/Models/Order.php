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
    protected $casts = [
        'delivery_date' => 'date', // Esto lo convierte a Carbon
        'finished_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
