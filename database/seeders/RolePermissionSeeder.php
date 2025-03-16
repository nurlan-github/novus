<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ruxsatnomalarni yaratish
        $permissions = [
            'admin_access',
            'show_dashboard',

            'show_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',

            'show_permissions',
            'create_permissions',
            'edit_permissions',
            'delete_permissions',

            'show_users',
            'create_users',
            'edit_users',
            'delete_users',

            'show_settings',
            'edit_settings',

            'show_keys',
            'create_keys',
            'edit_keys',
            'delete_keys',

            'show_languages',
            'create_languages',
            'edit_languages',
            'delete_languages',

            'show_keys_translate',
            'create_keys_translate',
            'edit_keys_translate',
            'delete_keys_translate',

            'show_translations',
            'create_translations',
            'edit_translations',
            'delete_translations',

            'show_categories',
            'create_categories',
            'edit_categories',
            'delete_categories',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Rollarni yaratish
        $adminRole = Role::create(['name' => 'admin']);
        $moderatorRole = Role::create(['name' => 'moderator']);
        $userRole = Role::create(['name' => 'user']);

        // Rollarga ruxsatnomalarni qo'shish
        $adminRole->givePermissionTo(Permission::all());
        $moderatorRole->givePermissionTo([
            'show_dashboard',
            'show_languages',
            'create_languages',
            'edit_languages',
        ]);

        // Foydalanuvchilarni yaratish va ularni ro'l va ruxsatnomalar bilan bog'lash

        // Admin foydalanuvchi
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@novus.dev',
            'password' => Hash::make('Admin@123'),
        ]);
        $admin->assignRole('admin');

        // Moderator foydalanuvchi
        $moderator = User::create([
            'name' => 'Moderator',
            'email' => 'moderator@novus.dev',
            'password' => Hash::make('Moderator@123'),
        ]);
        $moderator->assignRole('moderator');

        // User foydalanuvchi
        $user = User::create([
            'name' => 'User',
            'email' => 'user@novus.dev',
            'password' => Hash::make('User@123'),
        ]);
        $user->assignRole('user');
    }
}
