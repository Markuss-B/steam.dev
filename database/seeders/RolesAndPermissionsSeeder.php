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

        $roleHierarchy = [
            'guest' => [],
            'user' => ['guest'],
            'developer' => ['guest', 'user'],
            'admin' => ['guest', 'user', 'developer'],
        ];

        // Define permissions for each role
        $rolePermissions = [
            'guest' => [
                'games.index',
                'games.show',
                'developers.index',
                'developers.show',
                'tags.index',
                'tags.show',
            ],
            'user' => [],
            'developer' => [
                'games.create',
                'own_games.edit',
                'own_games.destroy',
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

            // Add permissions for this role and all roles lower in the hierarchy
            foreach ($roleHierarchy[$roleName] as $lowerRoleName) {
                $permissions = array_merge($permissions, $rolePermissions[$lowerRoleName]);
            }

            // Remove duplicates and create permissions
            $permissions = array_unique($permissions);

            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission]);
                $role->givePermissionTo($permission);
            }
        }

        // Finally, give all permissions to the admin
        $admin = Role::findByName('admin');
        $admin->givePermissionTo(Permission::all());
    }
}
