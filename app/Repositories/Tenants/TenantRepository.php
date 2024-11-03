<?php

namespace App\Repositories\Tenants;

use App\Models\Tenant;
use App\Repositories\BaseRepositoryEloquent;

/**
 * Class AreaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TenantRepository extends BaseRepositoryEloquent implements TenantRepositoryInterface
{
     /**
     * @return string
     */
    public function model(): string
    {
        return Tenant::class;
    }
}