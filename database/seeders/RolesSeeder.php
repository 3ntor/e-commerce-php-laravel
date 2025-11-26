<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default = Role::create(['name' => 'default']);
        $admin = Role::create(['name' => 'admin']);

        $manage_users = Permission::create(['name' => 'manage users']);



        $admin->givePermissionTo($permission);


    }
}
