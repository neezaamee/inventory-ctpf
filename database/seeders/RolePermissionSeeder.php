<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Define Permissions
        $permissions = [
            'manage-users',
            'manage-roles',
            'manage-inventory',
            'manage-officers',
            'manage-transactions',
            'view-reports'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Define Roles
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        // super-admin gets everything natively via Gate::before or we explicitly give it:
        $superAdmin->givePermissionTo(Permission::all());

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo([
            'manage-inventory', 'manage-officers', 'manage-transactions', 'view-reports'
        ]);

        $operator = Role::firstOrCreate(['name' => 'operator']);
        $operator->givePermissionTo([
            'manage-inventory', 'manage-transactions'
        ]);

        $viewer = Role::firstOrCreate(['name' => 'read-only']);
        $viewer->givePermissionTo(['view-reports']);
        
        // Attach super-admin to the first user if exists
        $user = User::first();
        if ($user) {
            $user->assignRole('super-admin');
        }
    }
}
