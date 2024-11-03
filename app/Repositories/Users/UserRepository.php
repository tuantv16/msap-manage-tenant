<?php

namespace App\Repositories\Users;

use App\Models\Role;
use App\Models\User;
use App\Repositories\BaseRepositoryEloquent;
use App\Repositories\Users\UserRepositoryInterface;
/**
 * Class AreaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepository extends BaseRepositoryEloquent implements UserRepositoryInterface
{
     /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    public function getAdminUsers($perPage = 10){
        return $this->model->with('roles')->paginate($perPage);
    }

    public function getSaleUsers($perPage = 10){
        return $this->model->whereHas('roles', function ($query) {
            $query->where('role_id', Role::SALE);
        })->with('roles')->paginate($perPage);
    }
}
