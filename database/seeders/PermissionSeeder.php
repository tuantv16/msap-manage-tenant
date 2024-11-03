<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create', 'description' => 'Create permission']);
        Permission::create(['name' => 'edit', 'description' => 'Edit permission']);
        Permission::create(['name' => 'delete', 'description' => 'Delete permission']);
        Permission::create(['name' => 'view', 'description' => 'View permission']);
    }
}
