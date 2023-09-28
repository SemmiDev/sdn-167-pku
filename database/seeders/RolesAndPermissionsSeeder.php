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

        $operatorSekolah = Role::create(['name' => UserRole::OPERATOR_SEKOLAH]);
        $operatorSekolah->givePermissionTo(Permission::all());

        Role::create(['name' => UserRole::KEPALA_SEKOLAH]);
        Role::create(['name' => UserRole::GURU_BK]);
        Role::create(['name' => UserRole::GURU_PEMBIMBING]);

        $superAdmin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        $superAdmin->assignRole($operatorSekolah);
    }
}
