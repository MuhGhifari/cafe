<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id'];

    public function order(){
    	return $this->belongsTo('App\Order', 'order_id');
    }

    public function cashier(){
    	return $this->belongsto('App\User', 'cashier_id');
    }
}
