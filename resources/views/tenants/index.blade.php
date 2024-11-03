<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tenants List') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        @include('layouts.title_content', ['breadcrumb' => 'Home / Tenants', 'title' => 'Tenants'])
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('tenants.create') }}" class="btn btn-primary">Create New Tenant</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle text-center mt-4">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Domain</th>
                    <th>Email</th>
                    <th>Services</th>
                    <th>Status</th>
                    <th>Actions</th>
                    <th>Change Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tenants as $tenant)
                    <tr>
                        <td>{{ $tenant->id }}</td>
                        <td>{{ $tenant->name }}</td>
                        <td>{{ $tenant->domain }}</td>
                        <td>{{ $tenant->email }}</td>
                        <td>
                            @if($tenant->service)
                                @php
                                    $serviceLabel = $serviceTypes[$tenant->service->service_type];
                                    $serviceClass = '';

                                    switch ($tenant->service->service_type) {
                                        case 'MS':
                                            $serviceClass = 'bg-primary';
                                            break;
                                        case 'SF':
                                            $serviceClass = 'bg-info';
                                            break;
                                        default:
                                            $serviceClass = 'bg-secondary';
                                            break;
                                    }
                                @endphp
                                <span class="badge {{ $serviceClass }}">
                                    {{ $serviceLabel }}
                                </span>
                            @else
                                <span class="badge bg-secondary">No Service</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $tenant->active == 0 ? 'bg-danger' : 'bg-success' }}">
                                {{ $tenant->active == 0 ? 'Deactive' : 'Active' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $tenant->id }}">
                                Delete
                            </button>

                            <div class="modal fade" id="deleteModal{{ $tenant->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $tenant->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $tenant->id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this tenant?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('tenants.toggleStatus', $tenant->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary btn-sm">
                                    Change
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
