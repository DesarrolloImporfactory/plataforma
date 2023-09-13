<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisosSeeder extends Seeder
{

    public function run()
    {
        $admin = Role::create(['name' => 'Admin']);
        $instructor = Role::create(['name' => 'Instructor']);

        Permission::create(['name' => 'View course'])->syncRoles([$instructor, $admin]);
        Permission::create(['name' => 'Delete course'])->syncRoles([$instructor, $admin]);
        Permission::create(['name' => 'Update Course'])->syncRoles([$instructor, $admin]);

        Permission::create(['name' => 'Admin roles'])->syncRoles([$instructor, $admin]);
        Permission::create(['name' => 'Admin sistem'])->syncRoles([$instructor, $admin]);
        Permission::create(['name' => 'Admin users'])->syncRoles([$instructor, $admin]);
    }
}
