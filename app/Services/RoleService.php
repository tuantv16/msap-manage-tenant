<?php

namespace App\Services;

use App\Repositories\Permissions\PermissionRepository;
use App\Repositories\Permissions\PermissionRepositoryInterface;
use App\Repositories\Roles\RoleRepositoryInterface;
use Illuminate\Validation\ValidationException;

class RoleService extends BaseService
{
    protected $roleRepository;
    protected $permissionRepository;

    public function __construct(RoleRepositoryInterface $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }
    
     
     /**
     * init data function
     *
     * @param 
     * @return
     */
    public function initData() {
        // get list permission
        $permissions = $this->permissionRepository->all();

        // get ...
        return [
           'permissions' => $permissions 
        ];
    }

     /**
     * create new permission function
     *
     * @param [array] $params
     * @return void
     */
    public function save($params) {
        $existingPermission = $this->roleRepository->findByName($params['name']);
        if ($existingPermission) {
            throw ValidationException::withMessages([
                'name' => 'Role with the same name already exists.',
            ]);
        }
        
        // transaction ở đây (chưa code)
        $role = $this->roleRepository->create($params);
    
        // set permissions in role
        $role->permissions()->sync($params['permissions']);

        return [];

    }

    /**
     * update function
     *
     * @param [type] $id
     * @param [type] $params
     * @return void
     */
    public function update($id, $params)
    {
        $id = intval($id);
        
        $permission = $this->roleRepository->find($id);
        if (!$permission) {
            throw new \Exception('Role not found.');
        }

        $existingPermission = $this->roleRepository->findByName($params['name']);
        if ($existingPermission && $existingPermission->id !== $id) {
            throw ValidationException::withMessages([
                'name' => 'Role with the same name already exists.',
            ]);
        }

        return $this->roleRepository->update($params, $id);
    }

    /**
     * delete permission function
     *
     * @param [integer] $id
     * @return void
     */
    public function delete($id)
    {
        $role = $this->roleRepository->find($id);

        if (!$role) {
            throw ValidationException::withMessages([
                'name' => 'Role not found.',
            ]);
        }

        return $this->roleRepository->delete($id);
    }

    /**
     * show function
     *
     * @param [int] $id
     * @return void
     */
    public function findById($id)
    {
        $role = $this->roleRepository->find($id);
        if (!$role) {
            throw ValidationException::withMessages([
                'name' => 'Role not found.',
            ]);
        }

        return $role;
    }
}