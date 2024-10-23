<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Crear o verificar permisos
        $permissions = [
            'gestionar productos',
            'gestionar pedidos',
            'gestionar inventarios',
            'crear usuarios',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles y asignar permisos si no existen
        $admin = Role::firstOrCreate(['name' => 'administrador']);
        $admin->syncPermissions($permissions); // Asignar todos los permisos al administrador

        $mesero = Role::firstOrCreate(['name' => 'mesero']);
        $mesero->syncPermissions(['gestionar pedidos']);

        $cocinero = Role::firstOrCreate(['name' => 'cocinero']);
        $cocinero->syncPermissions(['gestionar pedidos']);
    }
}
