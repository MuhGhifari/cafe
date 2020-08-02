<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = ['id'];

    public function order(){
      return $this->belongsTo('App\Order', 'order_id');
    }

    public function product(){
      return $this->belongsTo('App\Product', 'product_id');
    }
}
