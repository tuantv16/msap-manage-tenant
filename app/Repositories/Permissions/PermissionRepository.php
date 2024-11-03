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

    /**
     * searchPermission function
     *
     * @param [array] $params
     * @return collection
     */
    public function search($params)
    {
        $limit = !empty($params['per_page']) ? intval($params['per_page']) : self::PAGINATION_LIMIT;

        $query = $this->model->query();

        $query->when(!empty($params['permission_id']), function ($q) use ($params) {
            $q->where('id', $params['permission_id']);
        });

        $query->when(!empty($params['name']), function ($q) use ($params) {
            $q->where('name', 'LIKE', "%{$params['name']}%");
        });

        $query->when(!empty($params['description']), function ($q) use ($params) {
            $q->where('description', 'LIKE', "%{$params['description']}%");
        });

        return $query->paginate($limit);
    }
}
