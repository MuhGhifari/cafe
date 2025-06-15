<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
          'Brownies',
          'Cappucino',
          'Cokelat Panas',
          'Crepe Telur',
          'Donat',
          'Muffin Telur',
          'Jahe Panas',
          'Kopi Karamel',
          'Kopi Panas',
          'Sarapan Paleo ala Irlandia',
          'Pumpkin Spice',
        ];

        $image = [
          'brownies.jpg',
          'cappucino.jpg',
          'cokelat_panas.jpg',
          'crepe_telur.jpg',
          'donat.jpg',
          'egg_muffin.jpg',
          'jahe.jpg',
          'kopi_karamel.jpg',
          'kopi_panas.jpg',
          'paleo.jpg',
          'pumpkin_pie.jpg',
        ];

        $price = [
          5000,
          6000,
          6000,
          7000,
          3000,
          5000,
          2000,
          6000,
          3000,
          30000,
          9000,
        ];

        $category_id = [
          5,
          2,
          4,
          1,
          5,
          3,
          4,
          2,
          2,
          1,
          4,
        ];

        $stock = [
          20,
          20,
          20,
          15,
          40,
          50,
          25,
          30,
          30,
          10,
          25,
        ];

        for ($i=0; $i < count($name); $i++) { 
          Product::create([
            'name' => $name[$i],
            'image' => $image[$i],
            'price' => $price[$i],
            'category_id' => $category_id[$i],
            'stock' => $stock[$i],
          ]);
        }
    }
}
