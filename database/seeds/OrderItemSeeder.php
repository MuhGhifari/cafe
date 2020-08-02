<?php

use Illuminate\Database\Seeder;
use App\OrderItem;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $order_id = [
        1,
        1,
        1,
        2,
        2
      ];

      $product_id = [
        1,
        2,
        3,
        4,
        5
      ];

      for ($i=0; $i < count($order_id); $i++) { 
        OrderItem::create([
          'order_id' => $order_id[$i],
          'product_id' => $product_id[$i],
        ]);
      }
    }
}
