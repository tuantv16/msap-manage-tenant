<?php

namespace App\Services;

use App\Repositories\Permissions\PermissionRepositoryInterface;
use App\Repositories\Roles\RoleRepositoryInterface;
use Illuminate\Validation\ValidationException;

class PermissionService extends BaseService
{
    protected $permissionRepository;
    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * list search function
     *
     * @param [array] $params
     * @return void
     */
    public function search($params) {
        return $this->permissionRepository->search($params);
    }

    /**
     * create new permission function
     *
     * @param [array] $params
     * @return void
     */
    public function save($params) {

        $existingPermission = $this->permissionRepository->findByName($params['name']);
        if ($existingPermission) {
            throw ValidationException::withMessages([
                'name' => 'Permission with the same name already exists.',
            ]);
        }
        
        return $this->permissionRepository->create($params);

    }

    /**
     * update permission function
     *
     * @param [integer] $id
     * @param [array] $params
     * @return void
     */
    public function update($id, $params)
    {
        $id = intval($id);
        
        $permission = $this->permissionRepository->find($id);
        if (!$permission) {
            throw new \Exception('Permission not found.');
        }

        $existingPermission = $this->permissionRepository->findByName($params['name']);
        if ($existingPermission && $existingPermission->id !== $id) {
            throw ValidationException::withMessages([
                'name' => 'Permission with the same name already exists.',
            ]);
        }

        return $this->permissionRepository->update($params, $id);
    }

    /**
     * delete permission function
     *
     * @param [integer] $id
     * @return void
     */
    public function delete($id)
    {
        $permission = $this->permissionRepository->find($id);
        if (!$permission) {
            throw ValidationException::withMessages([
                'name' => 'Permission not found.',
            ]);
        }
        
        return $this->permissionRepository->delete($id);
    }

    /**
     * show function
     *
     * @param [int] $id
     * @return void
     */
    public function findById($id)
    {
        $permission = $this->permissionRepository->find($id);
        if (!$permission) {
            throw ValidationException::withMessages([
                'name' => 'Permission not found.',
            ]);
        }

        return $permission;
    }

}