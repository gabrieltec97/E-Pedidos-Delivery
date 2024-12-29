<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
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

        $administrador = Role::create(['name' => 'Administrador']);
        $operador = Role::create(['name' => 'Operador']);
        $entregador = Role::create(['name' => 'Entregador']);

        //Permissões do sistema.
        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'gerenciar pedidos']);
        Permission::create(['name' => 'entregar pedidos']);
        Permission::create(['name' => 'gerenciar itens']);
        Permission::create(['name' => 'gerenciar bairros']);
        Permission::create(['name' => 'gerenciar usuários']);

        //Permissões de administrador.
        $administrador->givePermissionTo(['dashboard', 'gerenciar pedidos', 'gerenciar itens', 'gerenciar bairros', 'gerenciar usuários']);
        $operador->givePermissionTo(['gerenciar pedidos', 'gerenciar itens', 'gerenciar bairros']);
        $entregador->givePermissionTo(['entregar pedidos']);
    }
}
