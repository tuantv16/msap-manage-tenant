<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Get roles and permissions
       $adminRole = Role::where('name', 'Admin')->first();
       $editorRole = Role::where('name', 'Sale')->first();
       $viewerRole = Role::where('name', 'Viewer')->first();

       $createPermission = Permission::where('name', 'create')->first();
       $editPermission = Permission::where('name', 'edit')->first();
       $deletePermission = Permission::where('name', 'delete')->first();
       $viewPermission = Permission::where('name', 'view')->first();

       // Assign permissions to roles
       RolePermission::create(['role_id' => $adminRole->id, 'permission_id' => $createPermission->id]);
       RolePermission::create(['role_id' => $adminRole->id, 'permission_id' => $editPermission->id]);
       RolePermission::create(['role_id' => $adminRole->id, 'permission_id' => $deletePermission->id]);
       RolePermission::create(['role_id' => $adminRole->id, 'permission_id' => $viewPermission->id]);

       RolePermission::create(['role_id' => $editorRole->id, 'permission_id' => $editPermission->id]);
       RolePermission::create(['role_id' => $editorRole->id, 'permission_id' => $viewPermission->id]);

       RolePermission::create(['role_id' => $viewerRole->id, 'permission_id' => $viewPermission->id]);

    }
}
