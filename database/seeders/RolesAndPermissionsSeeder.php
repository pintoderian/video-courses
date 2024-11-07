<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view courses',
            'create courses',
            'edit courses',
            'delete courses',
            'view videos',
            'create videos',
            'edit videos',
            'delete videos',
            'approve comments',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Asignar permisos al rol de admin
        $adminRole->givePermissionTo(Permission::all());

        // Asignar permisos al rol de usuario
        $userRole->givePermissionTo([
            'view courses',
            'view videos',
        ]);
    }
}
