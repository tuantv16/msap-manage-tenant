<?php

namespace App\Repositories\Permissions;

use App\Repositories\BaseRepositoryInterface;

interface PermissionRepositoryInterface extends BaseRepositoryInterface
{
    public function findByName($name);

    public function search($params);
}
