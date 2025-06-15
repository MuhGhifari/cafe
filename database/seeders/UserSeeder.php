<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
          'Admin',
          'Kasir',
          'Member',
        ];

        $password = [
          bcrypt('admin'),
          bcrypt('kasir'),
          bcrypt('member'),
        ];

        $email = [
          'admin@gmail.com',
          'kasir@gmail.com',
          'member@gmail.com',
        ];

        $role = [
          'admin',
          'kasir',
          'member',
        ];

        for ($i=0; $i < 3; $i++) { 
          User::create([
            'name' => $name[$i],
            'email' => $email[$i],
            'password' => $password[$i],
            'role' => $role[$i],
          ]);
        }
    }
}
