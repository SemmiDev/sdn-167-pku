<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $superAdminRole = Role::create(['name' => UserRole::SUPER_ADMIN]);
        $superAdminRole->givePermissionTo(Permission::all());

        Role::create(['name' => UserRole::SCHOOL_ADMINISTRATOR]);
        Role::create(['name' => UserRole::COUNSELOR_TEACHER]);
        Role::create(['name' => UserRole::RELIGION_TEACHER]);

        $superAdmin = User::create([
            'name' => 'kel-2',
            'email' => 'kel-2@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $superAdmin->assignRole($superAdminRole);
    }
}