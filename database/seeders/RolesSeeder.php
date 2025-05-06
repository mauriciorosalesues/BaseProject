<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Administrador
        $roleAdmin = Role::where('name', 'admin')->first();
        if (!$roleAdmin) {
            $roleAdmin = Role::create(['name' => 'admin']);
        }

        // Usuario
        $roleUsuario = Role::where('name', 'usuario')->first();
        if (!$roleUsuario) {
            $roleUsuario = Role::create(['name' => 'usuario']);
        }

        // ROLES Y PERMISOS
        $permissionRolesPermisos = Permission::firstOrCreate(
            ['name' => 'sidebar.roles.y.permisos'],
            ['description' => 'sidebar seccion roles y permisos']
        );
        $permissionRolesPermisos->syncRoles($roleAdmin);

        // PERMISO PARA VISTA DASHBOARD
        $permissionDashboard = Permission::firstOrCreate(
            ['name' => 'sidebar.dashboard'],
            ['description' => 'sidebar dashboard']
        );
        $permissionDashboard->syncRoles($roleUsuario);
    }
}