<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Role') }}
        </h2>
    </x-slot>

    <div class="">
        @include('layouts.header', ['breadcrumb' => 'Home / Role', 'title' => 'Role'])
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
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

                <form action="{{ route('admin.roles.store') }}" method="POST">
                    @csrf
    
                    <!-- Wrapper for two-column layout -->
                    <div class="grid grid-cols-2 gap-10 p-4">
                        <!-- Left column -->
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="form-label label-color">Roles name</label>
                                <span class="required-color">*</span>
                                <input type="text" name="name" id="name" class="form-control input-text" value="{{ old('name') }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="name" class="form-label label-color">Permission</label>
                                <select class="form-control select-multi" id="permissions" name="permissions[]" multiple="multiple">
                                    @if (!empty($data['permissions']))
                                        @foreach($data['permissions'] as $permission) 
                                            <option value="{{ $permission->id}}">{{ $permission->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
    
                        <!-- Right column -->
                        <div class="space-y-4">
                            <div>
                                <label for="description" class="form-label label-color">Description</label>
                                <input type="text" name="description" id="description" class="form-control input-text" value="{{ old('description') }}">
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <!-- Adjusted Button alignment -->
                        <div class="flex justify-end mt-6" style="padding-right:25px">
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary mr-3">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

    @vite('resources/js/roles/role.js')
</x-app-layout>
