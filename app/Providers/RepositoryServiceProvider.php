<?php

namespace App\Providers;

use App\Repositories\Permissions\PermissionRepository;
use App\Repositories\Permissions\PermissionRepositoryInterface;
use App\Repositories\Roles\RoleRepository;
use App\Repositories\Roles\RoleRepositoryInterface;
use App\Repositories\PaymentMethodRepository\PaymentMethodRepositoryInterface;
use App\Repositories\PaymentMethodRepository\PaymentMethodRepository;
use App\Repositories\Tenants\TenantRepository;
use App\Repositories\Tenants\TenantRepositoryInterface;
use App\Repositories\Users\UserRepository;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TenantRepositoryInterface::class, TenantRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(PaymentMethodRepositoryInterface::class, PaymentMethodRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
