<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Permission') }}
        </h2>
    </x-slot>

    <div class="">
      
        @include('layouts.header', [
            'breadcrumb' => 'EXV / Master / Permission',
            'title' => 'Permission',
            'backLink' => route('admin.permissions.index')
        ])

    </div>

    <div class="p-4">
        <div class="bg-white">
            <div class="p-6">
                <h2 class="information">Information</h2>
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

                <!-- Form chỉnh sửa -->
                <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
                    @csrf
                    @method('PUT')
    
                    <!-- Wrapper for two-column layout -->
                    <div class="grid grid-cols-2 gap-10 p-4">
                        <!-- Left column -->
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="form-label label-color">Permission name</label>
                                <span class="required-color">*</span>
                                <input type="text" name="name" id="name" class="form-control input-text" value="{{ old('name', $permission->name) }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
    
                        <!-- Right column -->
                        <div class="space-y-4">
                            <div>
                                <label for="description" class="form-label label-color">Description</label>
                                <input type="text" name="description" id="description" class="form-control input-text" value="{{ old('description', $permission->description) }}">
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> 
                    </div>

                    <div class="space-y-8">
                        <!-- Adjusted Button alignment -->
                        <div class="flex justify-end mt-6" style="padding-right:25px">
                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary mr-3">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- @vite('resources/js/tenant.js') --}}
</x-app-layout>
