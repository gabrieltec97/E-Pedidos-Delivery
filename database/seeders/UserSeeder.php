<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();

        $user->firstname = 'Admin';
        $user->surname = 'E-Pedidos';
        $user->email = 'ad@t.com';
        $user->user_type = 'Administrador';
        $user->password = '123';
        $user->contact = '(11) 1234-56789';
        $user->save();

        $user->assignRole('Administrador');
    }
}
