<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('users')->insert([
//            'username' => 'admin',
//            'firstname' => 'Admin',
//            'lastname' => 'Admin',
//            'email' => 'admin@argon.com',
//            'password' => bcrypt('secret')
//        ]);

        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Operador']);
        Role::create(['name' => 'Cliente']);
        Role::create(['name' => 'Motoboy']);

        //Permissões de admin

    }
}
