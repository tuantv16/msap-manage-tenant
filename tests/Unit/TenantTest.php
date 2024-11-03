<?php

namespace Tests\Unit;

use App\Http\Controllers\Admin\Tenant\TenantController;
use App\Http\Requests\Tenant\CreateOrUpdateTenantRequest;
use App\Models\Tenant;
use App\Models\User;
use App\Services\TenantService\TenantService;
use Illuminate\Foundation\Testing\Concerns\InteractsWithSession;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Mockery;
use Tests\TestCase;

class TenantTest extends TestCase
{
    use InteractsWithSession;
    protected $tenantService;

    public function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
        // Create a mock for TenantService
        $this->tenantService = $this->createMock(TenantService::class);
        // Initialize TenantController with the TenantService mock
        $this->tenantController = new TenantController($this->tenantService);
    }
    protected function loginAsUser()
    {
        $user = $this->createMock(User::class);
        $user->method('getKey')->willReturn(1);
        $this->actingAs($user);
    }

    public function test_index_displays_tenants()
    {
        $this->loginAsUser();
        $tenants = [
            new Tenant(['id' => 1, 'name' => 'Tenant 1']),
            new Tenant(['id' => 2, 'name' => 'Tenant 2']),
            new Tenant(['id' => 3, 'name' => 'Tenant 3']),
        ];

        $this->tenantService->expects($this->once())
            ->method('getAll')
            ->willReturn(collect($tenants));
        $response = $this->tenantController->index();

        $this->assertEquals('tenants.index', $response->getName());

        $this->assertCount(3, $response->getData()['tenants']);
        $this->assertEquals(
            collect($tenants)->pluck('id')->toArray(),
            $response->getData()['tenants']->pluck('id')->toArray()
        );
    }

    public function test_create_displays_create_tenant_view()
    {
        $response = $this->tenantController->create();

        $this->assertEquals('tenants.create', $response->getName());
    }

    public function test_store__successfully_creates_tenant()
    {
        $request = CreateOrUpdateTenantRequest::create('/tenants', 'POST', [
            'name' => 'New Tenant'.uniqid(),
            'domain' => 'new-tenant.domain.com'.uniqid(),
            'email' => 'tenant@example.com'.uniqid()
        ]);

        $this->tenantService->method('create')->willReturn(new Tenant());

        $response = $this->tenantController->store($request);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(route('tenants.index'), $response->headers->get('Location'));
        $this->assertTrue(session()->has('success'));
        $this->assertEquals('Tenant created successfully!', session('success'));
    }
    public function test_store_fails_due_to_exception()
    {
        $request = CreateOrUpdateTenantRequest::create('/tenants', 'POST', [
            'name' => 'New Tenant'.uniqid(),
            'domain' => 'new-tenant.domain.com'.uniqid(),
            'email' => 'tenant@example.com'.uniqid()
        ]);

        $this->tenantService->method('create')->willThrowException(new \Exception('Creation failed'));

        $response = $this->tenantController->store($request);

        $this->assertEquals(302, $response->getStatusCode());

        $this->assertTrue(session()->has('errors'));

        $errors = session('errors');

        $this->assertTrue($errors->has('error'));
        $this->assertEquals('Tenant not created', $errors->first('error'));

        $this->assertDatabaseMissing('tenants', ['name' => 'New Tenant']);
    }


    public function test_edit_displays_tenant()
    {
        $this->loginAsUser();

        $this->tenantService = $this->createMock(TenantService::class);

        $tenant = Tenant::factory()->make(['domain' => 'unique-domain-' . uniqid() . '.example.com']);

        $this->tenantService->method('getById')->willReturn($tenant);

        $this->tenantController = new TenantController($this->tenantService);

        $response = $this->tenantController->edit($tenant->id);

        $this->assertInstanceOf(View::class, $response);

        $this->assertEquals('tenants.edit', $response->getName());
        $this->assertArrayHasKey('tenant', $response->getData());
        $this->assertEquals($tenant, $response->getData()['tenant']);
    }

    public function test_update_successfully_tenant()
    {
        $this->loginAsUser();

        $this->tenantService = $this->createMock(TenantService::class);

        $tenant = Tenant::factory()->create();
        $this->tenantService->expects($this->once())
            ->method('update')
            ->with($this->anything(), $tenant->id)
            ->willReturn($tenant);

        $this->tenantController = new TenantController($this->tenantService);

        $requestData = [
            'name' => 'Updated Tenant'.uniqid(),
            'domain' => 'example.com'.uniqid(),
            'email' => 'tenant@example.com'.uniqid(),
        ];

        $request = new CreateOrUpdateTenantRequest($requestData);

        $response = $this->tenantController->update($request, $tenant->id);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(route('tenants.index'), $response->headers->get('Location'));
        $this->assertTrue(session()->has('success'));
        $this->assertEquals('Tenant updated successfully!', session('success'));
    }

    public function test_update_fails_to_update_tenant()
    {
        $this->loginAsUser();

        $this->tenantService = $this->createMock(TenantService::class);

        $tenant = Tenant::factory()->create();
        $this->tenantService->expects($this->once())
            ->method('update')
            ->willThrowException(new \Exception('Update failed'));

        $this->tenantController = new TenantController($this->tenantService);

        $requestData = [
            'name' => 'Updated Tenant Name'.uniqid(),
            'domain' => 'updated-domain.com'.uniqid(),
            'email' => 'updated@example.com'.uniqid(),
        ];

        $request = new CreateOrUpdateTenantRequest($requestData);

        $response = $this->tenantController->update($request, $tenant->id);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(url()->previous(), $response->headers->get('Location'));

        $this->assertTrue(session()->has('error'));
        $this->assertEquals('Tenant not updated', session('error'));
    }

    public function test_destroy_deletes_tenant_successfully()
    {
        $this->loginAsUser();

        $this->tenantService = $this->createMock(TenantService::class);

        $tenant = Tenant::factory()->create();

        $this->tenantService->expects($this->once())
            ->method('delete')
            ->with($this->equalTo($tenant->id))
            ->willReturn(true);

        $this->tenantController = new TenantController($this->tenantService);

        $response = $this->tenantController->destroy($tenant->id);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(route('tenants.index'), $response->headers->get('Location'));

        $this->assertTrue(session()->has('success'));
        $this->assertEquals('Tenant deleted successfully!', session('success'));

    }

    public function test_destroy_fails_due_to_exception()
    {
        $this->loginAsUser();

        $this->tenantService = $this->createMock(TenantService::class);

        $tenant = Tenant::factory()->create();

        $tenant->saveQuietly();

        $this->tenantService->expects($this->once())
            ->method('delete')
            ->with($this->equalTo($tenant->id))
            ->will($this->throwException(new \Exception('Deletion failed')));

        $this->tenantController = new TenantController($this->tenantService);

        $response = $this->tenantController->destroy($tenant->id);


        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals(route('tenants.index'), $response->headers->get('Location'));
        $this->assertTrue(session()->has('error'));
        $this->assertEquals('Tenant not deleted', session('error'));
    }

    public function test_toggle_status_successfully()
    {
        $this->loginAsUser();
        $this->tenantService = $this->createMock(TenantService::class);

        $tenant = Tenant::factory()->create([
            'active' => 0,
            'domain' => 'test-tenant-' . uniqid() . '.example.com',
            'email' => 'test-' . uniqid() . '@example.com',
        ]);
        $tenant->active = 1;

        $this->tenantService->expects($this->once())
            ->method('toggleStatus')
            ->with($this->equalTo($tenant->id))
            ->willReturn($tenant);

        $this->tenantController = new TenantController($this->tenantService);

        $response = $this->tenantController->toggleStatus($tenant->id);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertTrue(session()->has('success'));
        $this->assertEquals('Tenant status updated to active successfully!', session('success'));
    }

    public function test_toggle_status_fails_due_to_exception()
    {
        $this->loginAsUser();
        $this->tenantService = $this->createMock(TenantService::class);
        $tenant = Tenant::factory()->create();

        $this->tenantService->expects($this->once())
            ->method('toggleStatus')
            ->with($this->equalTo($tenant->id))
            ->willThrowException(new \Exception('Toggle status failed'));

        $this->tenantController = new TenantController($this->tenantService);

        $response = $this->tenantController->toggleStatus($tenant->id);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertTrue(session()->has('error'));
        $this->assertEquals('Tenant status could not be updated', session('error'));
    }
    protected function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
        Mockery::close();
    }
}
