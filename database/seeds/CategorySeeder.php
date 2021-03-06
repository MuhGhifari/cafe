<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $name = [
        'Sarapan',
        'Kopi',
        'Makan Siang',
        'Minuman Panas',
        'Pastry',
      ];

      for ($i=0; $i < count($name); $i++) { 
        Category::create([
          'name' => $name[$i]
        ]);
      }
    }
}
