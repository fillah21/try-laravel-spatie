<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected static ?string $password;
    public function run(): void
    {
        $default = [
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'remember_token' => Str::random(10),
        ];

        $admin = User::create(array_merge([
            'email' => 'admin@gmail.com',
            'name' => 'Administrator'
        ], $default));

        $trainer = User::create(array_merge([
            'email' => 'trainer@gmail.com',
            'name' => 'Trainer'
        ], $default));

        $user = User::create(array_merge([
            'email' => 'user@gmail.com',
            'name' => 'User'
        ], $default));

        $role_admin = Role::create(['name' => 'Admin']);
        $role_trainer = Role::create(['name' => 'Trainer']);
        $role_user = Role::create(['name' => 'User']);

        $permission = Permission::create(['name' => 'create role']);
        $permission = Permission::create(['name' => 'read role']);
        $permission = Permission::create(['name' => 'update role']);
        $permission = Permission::create(['name' => 'delete role']);

        $admin->assignRole('Admin');
        $trainer->assignRole('Trainer');
        $user->assignRole('User');

        $admin->givePermissionTo('create role');
        $admin->givePermissionTo('read role');
        $admin->givePermissionTo('update role');
        $admin->givePermissionTo('delete role');
    }
}
