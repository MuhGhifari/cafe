<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\User;

class Order extends Model
{
    protected $guarded = ['id'];

    // Order belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Order has many items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Optional: Total quantity/items
    public function getTotalQuantityAttribute()
    {
        return $this->items->sum('quantity');
    }
}