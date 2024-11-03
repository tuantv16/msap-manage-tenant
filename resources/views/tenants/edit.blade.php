<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tenant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('tenants.update', $tenant->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $tenant->name) }}" required class="form-control" />
                    @error('name')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="domain" class="form-label">Domain</label>
                    <input type="text" name="domain" id="domain" value="{{ old('domain', $tenant->domain) }}" required class="form-control" readonly />
                    @error('domain')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $tenant->email) }}" required class="form-control" />
                    @error('email')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="form-label">Status</label>
                    <span class="badge {{ $tenant->active ? 'bg-success' : 'bg-danger' }}">
                        {{ $tenant->active ? 'Active' : 'Deactive' }}
                    </span>
                </div>

                <div class="mb-4">
                    <label for="service_type" class="form-label">Service Type</label>
                    <select name="service_type" id="service_type" class="form-control">
                        <option value="" disabled {{ old('service_type', $tenant->service->service_type ?? '') === '' ? 'selected' : '' }}>
                            Select Service
                        </option>
                        @foreach ($serviceTypes as $key => $value)
                            <option value="{{ $key }}" {{ (old('service_type', $tenant->service->service_type ?? '') == $key) ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                    @error('service_type')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Back to List</a>

                    <button type="submit" class="btn btn-primary">Update Tenant</button>
                </div>
            </form>
        </div>
    </div>

    @vite('resources/js/tenant.js')
</x-app-layout>
