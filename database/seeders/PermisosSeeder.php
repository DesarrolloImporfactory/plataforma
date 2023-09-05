<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermisosSeeder extends Seeder
{
    
    public function run()
    {
        Permission::create(['name'=>'View cuurse']);
        Permission::create(['name'=>'Delete course']);
        Permission::create(['name'=>'Update Course']);
    }
}
