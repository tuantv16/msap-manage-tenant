<?php

namespace App\Repositories\Roles;

use App\Models\Role;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Repositories\BaseRepositoryEloquent;

class RoleRepository extends BaseRepositoryEloquent implements RoleRepositoryInterface
{

    /**
     * @return string
    */
    public function model(): string
    {
        return Role::class;
    }

    /**
     * Find By Name Role function
     *
     * @param [string] $name
     * @return void
     */
    public function findByName($name) {
        return $this->model->where('name', $name)->first();
    }

}
