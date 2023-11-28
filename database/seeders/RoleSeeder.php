<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::select('id')->get();

        //Create admin role
        //Admin give all the permission
        Role::updateOrCreate([
            'role_name' => 'Admin',
            'role_slug' => 'admin',
            'is_deletable' => false
        ])->permissions()->sync($permissions->pluck('id'));



        //Create user role
        Role::updateOrCreate([
            'role_name' => 'User',
            'role_slug' => 'user',
            'is_deletable' => true
        ]);
    }
}
