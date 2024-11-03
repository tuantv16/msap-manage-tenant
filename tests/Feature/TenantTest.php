<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use App\Services\TenantService\TenantService;
use Illuminate\Support\Facades\DB;
use Mockery;
use Tests\TestCase;
class TenantTest extends TestCase
{
    protected function loginAsUser()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }
    protected function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
        $this->loginAsUser();
    }
    public function test_index_displays_tenant_list_and_service_types()
    {
        $tenants = Tenant::factory()->count(3)->create();

        $this->mock(TenantService::class, function ($mock) use ($tenants) {
            $mock->shouldReceive('getAll')->once()->andReturn($tenants);
        });

        $response = $this->get(route('tenants.index'));

        $response->assertStatus(200);

        $response->assertViewIs('tenants.index');

        $response->assertViewHas('tenants', $tenants);
        $response->assertViewHas('serviceTypes', config('services.service_types'));
    }
    public function test_create_displays_tenant_creation_form()
    {

        $response = $this->get(route('tenants.create'));

        $response->assertStatus(200);
        $response->assertViewIs('tenants.create');
    }

    public function test_store_successfully()
    {
        $tenantData = Tenant::factory()->make(['domain' => 'unique-domain-' . uniqid() . '.com'])->toArray();

        $response = $this->post(route('tenants.store'), $tenantData);

        $response->assertRedirect(route('tenants.index'));
        $response->assertSessionHas('success', 'Tenant created successfully!');
    }

    public function test_store_fails_due_to_exception()
    {
        $tenantData = Tenant::factory()->make()->toArray();
        $this->mock(TenantService::class, function ($mock) {
            $mock->shouldReceive('create')
                ->once()
                ->andThrow(new \Exception('Some error occurred'));
        });

        $response = $this->post(route('tenants.store'), $tenantData);
        $this->assertDatabaseMissing('tenants', $tenantData);
        $response->assertSessionHasErrors(['error' => 'Tenant not created']);
    }

    public function test_edit_displays_correct_tenant_and_service_types()
    {
        $tenant = Tenant::factory()->create();

        $this->mock(TenantService::class, function ($mock) use ($tenant) {
            $mock->shouldReceive('getById')->once()->with($tenant->id)->andReturn($tenant);
        });
        $response = $this->get(route('tenants.edit', $tenant->id));

        $response->assertStatus(200);
        $response->assertViewIs('tenants.edit');
        $response->assertViewHas('tenant', $tenant);
        $response->assertViewHas('serviceTypes', config('services.service_types'));
    }

    public function test_update_successfully_updates_tenant()
    {
        $tenant1 = Tenant::factory()->create();
        $tenant2 = Tenant::factory()->make()->toArray();

        $response = $this->put(route('tenants.update', ['tenant' => $tenant1['id']]), $tenant2);

        $response->assertStatus(302);
        $response->assertRedirect(route('tenants.index'));
        $response->assertSessionHas('success', 'Tenant updated successfully!');

        $this->assertDatabaseHas('tenants', [
            'id' => $tenant1['id'],
            'name' => $tenant2['name'],
            'domain' => $tenant2['domain'],
            'email' => $tenant2['email'],
        ]);
    }

    public function test_update_fails_due_to_validation()
    {

        $tenant = Tenant::factory()->create([
            'active' => 1,
            'domain' => 'test-tenant-' . uniqid() . '.example.com',
            'email' => 'test-' . uniqid() . '@example.com',
        ]);
        $data = [
            'name' => '',
            'domain' => 'invalid_domain',
            'email' => 'invalid-email-format',
        ];
        $response = $this->putJson(route('tenants.update', ['tenant' => $tenant->id]), $data);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'domain', 'email']);
    }

    public function test_destroy_successfully_deletes_tenant()
    {
        $tenant = Tenant::factory()->create();
        $tenantId = $tenant->id;

        $tenantMock = \Mockery::mock(Tenant::class);

        $tenantMock->shouldReceive('findOrFail')
            ->with($tenantId)
            ->andReturn($tenantMock);

        $tenantMock->shouldReceive('delete')->once();

        $this->app->instance(Tenant::class, $tenantMock);

        $response = $this->delete(route('tenants.destroy', ['tenant' => $tenantId]));

        $response->assertStatus(302);
        $response->assertRedirect(route('tenants.index'));
        $response->assertSessionHas('success', 'Tenant deleted successfully!');

    }

    public function test_destroy_redirects_with_error_message_on_exception()
    {
        $tenant = Tenant::factory()->create([
            'active' => 1,
            'domain' => 'test-tenant-' . uniqid() . '.example.com',
            'email' => 'test-' . uniqid() . '@example.com',
        ]);
        $tenantServiceMock = Mockery::mock(TenantService::class);
        $tenantServiceMock->shouldReceive('delete')->with($tenant->id)->andThrow(new \Exception('Error deleting tenant'));
        $this->app->instance(TenantService::class, $tenantServiceMock);

        $response = $this->delete(route('tenants.destroy', ['tenant' => $tenant->id]));

        $response->assertStatus(302);
        $response->assertRedirect(route('tenants.index'));

        $response->assertSessionHas('error', 'Tenant not deleted');
    }

    public function test_tenant_activation_status_changes_correctly() {
        $tenant = Tenant::factory()->create(['active' => false]);
        $this->assertFalse($tenant->active, 'Tenant should be inactive before toggle.');
        $response = $this->post(route('tenants.toggleStatus', ['id' => $tenant->id]));
        $tenant->refresh();
        $this->assertTrue($tenant->active == 1, 'Tenant should be active after toggle.');
        $response->assertRedirect(route('tenants.index'));
    }

    public function test_toggle_status_redirects_with_error_message_on_exception()
    {
        $tenant = Tenant::factory()->create();
        $tenantMock = Mockery::mock(Tenant::class);
        $tenantMock->shouldReceive('getAttribute')->with('active')->andReturn(false);
        $tenantMock->shouldReceive('getAttribute')->with('id')->andReturn(1);

        $tenantServiceMock = Mockery::mock(TenantService::class);
        $tenantServiceMock->shouldReceive('find')->with($tenant->id)->andReturn($tenantMock);
        $tenantServiceMock->shouldReceive('toggleStatus')->with($tenant->id)->andThrow(new \Exception('Error toggling status'));

        $this->app->instance(TenantService::class, $tenantServiceMock);
        $response = $this->post(route('tenants.toggleStatus', ['id' => 1]));

        $response->assertStatus(302);
        $response->assertRedirect(route('tenants.index'));
        $this->assertEquals('Tenant status could not be updated', session('error'));
    }

    protected function tearDown(): void
    {
        DB::rollBack();
        parent::tearDown();
        Mockery::close();
    }

}
