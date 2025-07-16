<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
        ]);
        // User::factory(10)->create();

        // Create admin user or get existing
        $admin = User::firstOrCreate(
            [
                'email' => 'admin@example.com',
            ],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'), // Only set if creating
            ]
        );

        // Create admin role
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        // Assign all permissions to admin role
        $allPermissions = Permission::pluck('name');
        $adminRole->syncPermissions($allPermissions);

       
        $admin->assignRole($adminRole);
       
        $anotherAdmin = User::firstOrCreate(
            ['email' => 'anotheradmin@example.com'],
            ['name' => 'Another Admin', 'password' => bcrypt('password')]
        );
        $anotherAdmin->assignRole($adminRole);
    }
}
