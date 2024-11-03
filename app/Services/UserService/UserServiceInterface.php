<?php

namespace App\Services\UserService;

use App\Services\BaseServices\BaseServiceRepositoriesInterface;

interface UserServiceInterface extends BaseServiceRepositoriesInterface
{
    public function resetPassword($request, $id);

    public function getListUserAdmin($relation = [], $columns = ['*'], $condition = [], $perPage = 10);

    public function getListSales($relation = [], $columns = ['*'], $condition = [], $perPage = 10);
}
