<?php

namespace App\Http\Controllers\Admin\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\CreateOrUpdateTenantRequest;
use App\Services\TenantService\TenantService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TenantController extends Controller
{
    public function __construct(protected TenantService $tenantService)
    {
    }

    public function index()
    {
        $tenants = $this->tenantService->getAll();
        $serviceTypes = config('services.service_types');
        return view('tenants.index', compact('tenants', 'serviceTypes'));
    }

    public function create()
    {
        return view('tenants.create');
    }

    public function store(CreateOrUpdateTenantRequest $request)
    {
        try {
            $this->tenantService->create($request);
            return redirect()->route('tenants.index')->with('success', 'Tenant created successfully!');
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect()->back()->withErrors(['error' => 'Tenant not created']);
        }
    }

    public function edit($id)
    {
        $tenant = $this->tenantService->getById($id);
        $serviceTypes = config('services.service_types');
        return view('tenants.edit', compact('tenant','serviceTypes'));
    }

    public function update(CreateOrUpdateTenantRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->tenantService->update($request, $id);
            DB::commit();
            return redirect()->route('tenants.index')->with('success', 'Tenant updated successfully!');
        } catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'Tenant not updated');
        }

    }

    public function destroy($id)
    {
        try {
            $this->tenantService->delete($id);
            return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully!');
        } catch (ModelNotFoundException $exception) {
            return redirect()->route('tenants.index')->with('error', 'Tenant not found');
        } catch (\Exception $exception) {
            Log::error('Delete tenant error: ' . $exception->getMessage());
            return redirect()->route('tenants.index')->with('error', 'Tenant not deleted');
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
            $tenant = $this->tenantService->toggleStatus($id);
            DB::commit();
            return redirect()->route('tenants.index')->with('success', 'Tenant status updated to ' . ($tenant->active ? 'active' : 'inactive') . ' successfully!');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage());
            return redirect()->route('tenants.index')->with('error', 'Tenant status could not be updated');
        }
    }

}
