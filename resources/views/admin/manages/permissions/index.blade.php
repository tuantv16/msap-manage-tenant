<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Permission') }}
        </h2>
    </x-slot>

    <div class="">
        @include('layouts.header', [
            'breadcrumb' => 'EXV / Master / Permission',
            'title' => 'Permission'
        ])

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show m-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="p-4">
        <div class="bg-white">
            <div class="p-6">
                <h2 class="information">Search</h2>
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

                <form action="{{ route('admin.permissions.index') }}" method="GET">
                    <!-- Wrapper for two-column layout -->
                    <div class="grid grid-cols-2 gap-10 p-4">
                        <!-- Left column -->
                        <div class="space-y-4">
                            <div>
                                <label for="permission_id" class="form-label label-color">Permission ID</label>
                                <input type="text" name="permission_id" id="permission_id" class="form-control input-text" value="{{ request('permission_id') }}">
                            </div>

                            <div>
                                <label for="description" class="form-label label-color">Description</label>
                                <input type="text" name="description" id="description" class="form-control input-text" value="{{ request('description') }}">
                            </div>
                        </div>

                        <!-- Right column -->
                        <div class="space-y-4">
                            <div class="space-y-4">
                                <div>
                                    <label for="name" class="form-label label-color">Permission name</label>
                                    <input type="text" name="name" id="name" class="form-control input-text" value="{{ request('name') }}">
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label for="create_at" class="form-label label-color">Create date</label>
                                    <input type="text" name="create_at" id="create_at" class="form-control input-text" value="{{ request('create_at') }}">
                                </div>
                            </div>
                        </div>
 
                    </div>
                    <div class="space-y-8">
                        <!-- Adjusted Button alignment -->
                        <div class="flex justify-end mt-6" style="padding-right:25px">
                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-clear mr-3">Clear</a>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="p-4 pt-0">
        <div class="bg-white">
            <div class="p-6">
                <div class="flex justify-between items-center pb-3">
                    <h2 class="text-lg font-semibold">Table</h2>
                    <button class="btn btn-primary">+ Add New</button>
                </div>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Permission ID</th>
                            <th>Permission name</th>
                            <th>URL</th>
                            <th>Description</th>
                            <th>Create date</th>
                            <th>Last update date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->url }}</td>
                                <td>{{ $permission->description }}</td>
                                <td>{{ \Carbon\Carbon::parse($permission->created_at)->format('Y/m/d') }}</td>
                                <td>{{ \Carbon\Carbon::parse($permission->updated_at)->format('Y/m/d') }}</td>
                                <td class="tr-action">
                                    <a href="{{ route('admin.permissions.show', $permission->id) }}" class="action-link">Detail</a>
                                    <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="action-link">Edit</a>
                                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-link">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
    
                <!-- pagination -->
                <x-pagination :items="$permissions" />       
           
            </div>
        </div>
    </div>
    
    {{-- @vite('resources/js/tenant.js') --}}
</x-app-layout>
