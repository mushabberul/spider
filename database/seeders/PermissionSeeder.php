<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'Access Dashboard',
            'User Index',
            'User Create',
            'User Update',
            'User Delete',
            'Role Index',
            'Role Create',
            'Role Update',
            'Role Delete'
        ];

        $module = Module::where('module_slug', 'dashboard-access')->first();

        for ($i = 0; $i < 1; $i++) {
            Permission::updateOrCreate([
                'permission_name' => $permissions[$i],
                'permission_slug' => Str::slug($permissions[$i]),
                'module_id' => $module->id

            ]);
        }
        $module = Module::where('module_slug', 'user-management')->first();

        for ($i = 1; $i < 5; $i++) {
            Permission::updateOrCreate([
                'permission_name' => $permissions[$i],
                'permission_slug' => Str::slug($permissions[$i]),
                'module_id' => $module->id
            ]);
        }
        $module = Module::where('module_slug', 'role-management')->first();
        for ($i = 5; $i < 9; $i++) {
            Permission::updateOrCreate([
                'permission_name' => $permissions[$i],
                'permission_slug' => Str::slug($permissions[$i]),
                'module_id' => $module->id
            ]);
        }
    }
}
