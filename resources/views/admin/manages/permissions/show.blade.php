<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Permission') }}
        </h2>
    </x-slot>

    <div class="">
        @include('layouts.header', [
            'breadcrumb' => 'EXV / Master / Permission / ' . $permission->id,
            'title' => $permission->id,
            'backLink' => route('admin.permissions.index')
        ])
    </div>

    <div class="p-4">
        <div class="bg-white">
            <div class="p-6">
                <h2 class="information">Information </h2>
                    <div class="grid grid-cols-2 gap-10 p-4">
                        <!-- Left column -->
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="form-label label-color">Permission name</label>
                                <span class="required-color">*</span>
                                <p>{{ $permission->name }}</p>
                            </div>
                        </div>
    
                        <!-- Right column -->
                        <div class="space-y-4">
                            <div>
                                <label for="description" class="form-label label-color">Description</label>
                                <p>{{ $permission->description }}</p>
                            </div>

                            <div>
                                <label for="url" class="form-label label-color">URL</label>
                                <p>{{ $permission->url ?? '' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        <!-- Adjusted Button alignment -->
                        <div class="flex justify-end mt-6" style="padding-right:25px">
                            <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>

            </div>
        </div>
    </div>

</x-app-layout>
