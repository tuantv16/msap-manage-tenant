<div class="bg-white border-right">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt"></i>
                {{ __('Dashboard') }}
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-users"></i>
                {{ __('Users') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('sales.index') }}">
                <i class="fa-solid fa-person-half-dress"></i>
                {{ __('Sales') }}
            </a>
        </li>

        <li class="nav-item">
            <button class="nav-link d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#tenantDropdown" aria-expanded="false" aria-controls="tenantDropdown">
                <i class="fas fa-building me-2"></i>
                {{ __('Tenants') }}
                <i class="fas fa-chevron-down ms-auto rotate-icon"></i>
            </button>
            <div id="tenantDropdown" class="collapse">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tenants.index') }}">
                            {{ __('Tenant List') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tenants.create') }}">
                            {{ __('Create Tenant') }}
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>
