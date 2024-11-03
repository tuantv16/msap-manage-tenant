<?php

namespace App\Repositories\Permissions;

use App\Models\Permission;
use App\Repositories\BaseRepositoryEloquent;

class PermissionRepository extends BaseRepositoryEloquent implements PermissionRepositoryInterface
{

    /**
     * @return string
    */
    public function model(): string
    {
        return Permission::class;
    }
    
    /**
     * Find By Name Permission function
     *
     * @param [string] $name
     * @return void
     */
    public function findByName($name) {
        return $this->model->where('name', $name)->first();
    }

    public function search($params) {
        $query = $this->model->query();

        if (!empty($params['name'])) {
            $query->where('name', 'LIKE', "%{$params['name']}%");
        }
    
        if (!empty($params['description'])) {
            $query->where('description', 'LIKE', "%{$params['description']}%");
        }

        return $this->paginate(20);
    }
}
