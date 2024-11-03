<?php

namespace App\Services\TenantService;

use App\Repositories\Tenants\TenantRepositoryInterface;
use App\Services\BaseService;
class TenantService extends BaseService
{

    protected $tenantRepository;
    public function __construct(TenantRepositoryInterface $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
    }

    public function getAll()
    {
        return $this->tenantRepository->all();
    }

    public function getById($id)
    {
        return $this->tenantRepository->find($id);
    }

    public function create($request)
    {
        $params = [
            'name' => $request->name,
            'domain' => $request->domain,
            'email' => $request->email
        ];

        $tenant = $this->tenantRepository->create($params);

        if ($request->has('service_type')) {
            $serviceType = $request->service_type;
            $tenant->service()->create(['service_type' => $serviceType]);
        }

        return $tenant;
    }

    public function update($request, $id)
    {
        $params = [
            'name' => $request->name,
            'domain' => $request->domain,
            'email' => $request->email,
        ];

        $tenant = $this->tenantRepository->update($params, $id);

        if ($request->has('service_type')) {
            $serviceType = $request->service_type;

            $service = $tenant->service;
            if ($service) {
                $service->update(['service_type' => $serviceType]);
            } else {
                $tenant->service()->create(['service_type' => $serviceType]);
            }
        }

        return $tenant;
    }

    public function delete($id)
    {
        return $this->tenantRepository->softDelete($id);
    }

    public function toggleStatus($id)
    {
        $tenant = $this->tenantRepository->find($id);
        $tenant->active = !$tenant->active;
        $tenant->save();

        return $tenant;
    }

    public function paginate($relation = [], $columns = ['*'], $perPage = 10)
    {
        // TODO: Implement paginate() method.
    }
}
