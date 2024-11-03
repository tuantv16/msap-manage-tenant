<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Tenant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <!-- Hiển thị các lỗi từ server -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('tenants.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="domain" class="form-label">Domain</label>
                        <input type="text" name="domain" id="domain" class="form-control" readonly value="{{ old('domain') }}" required>
                        @error('domain')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="service_type" class="form-label">Service Type</label>
                        <select name="service_type" id="service_type" class="form-control">
                            <option value="" disabled {{ old('service_type') === null ? 'selected' : '' }}>
                                Select Service
                            </option>
                            <option value="ALL" {{ old('service_type') === 'ALL' ? 'selected' : '' }}>ALL</option>
                            <option value="MS" {{ old('service_type') === 'MS' ? 'selected' : '' }}>MSAP</option>
                            <option value="SF" {{ old('service_type') === 'SF' ? 'selected' : '' }}>SANFEE</option>
                        </select>
                        @error('service_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Back to List</a>

                        <button type="submit" class="btn btn-primary">Create Tenant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @vite('resources/js/tenant.js')
</x-app-layout>
