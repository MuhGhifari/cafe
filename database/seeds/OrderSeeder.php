<?php

use Illuminate\Database\Seeder;
use App\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user_id = [2,3];
      $name = ['kasir','member'];

      for ($i=0; $i < count($user_id); $i++) { 
        Order::create([
          'user_id' => $user_id[$i],
          'name' => $name[$i]
        ]);
      }
    }
}
