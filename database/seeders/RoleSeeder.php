<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['id' => 1,'name' => 'Admin', 'description' => 'Administrator role']);
        Role::create(['id' => 2,'name' => 'Sale', 'description' => 'Sale role']);
        Role::create(['name' => 'Viewer', 'description' => 'Viewer role']);
    }
}
