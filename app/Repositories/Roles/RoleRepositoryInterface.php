<?php

namespace App\Repositories\Roles;

use App\Repositories\BaseRepositoryInterface;

interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    public function findByName($name);
}
