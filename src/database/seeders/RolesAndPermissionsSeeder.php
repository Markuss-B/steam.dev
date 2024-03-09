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
        // forget cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions for each role
        $rolePermissions = [
            'developer' => [
                'own_developers.edit',
                'own_games.create',
                'own_games.edit',
            ],
            'admin' => [
                'games.create',
                'games.edit',
                'games.destroy',
                'developers.create',
                'developers.edit',
                'developers.destroy',
                'tags.create',
                'tags.edit',
                'tags.destroy',
            ],
        ];

        // Create all permissions and assign them to the roles
        foreach ($rolePermissions as $roleName => $permissions) {
            // Create role
            $role = Role::firstorcreate(['name' => $roleName]);
            // delete current permissions if there are any
            $role->permissions()->detach();

            // Add permissions for this role 
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission]);
                $role->givePermissionTo($permission);
            }
        }
    }
}
