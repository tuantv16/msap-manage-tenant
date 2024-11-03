<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Payment Method') }}
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
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('payment_methods.update', $paymentMethod->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $paymentMethod->name) }}" required>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Infor</label>
                        <div class="infor">
                            @foreach ($paymentMethod['infor'] as $key => $value)
                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <input type="text" name="key[]" id="key" class="form-control" value="{{ $key }}" placeholder="key">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="value[]" id="value" class="form-control" value="{{ $value }}" placeholder="value">
                                    </div>
                                </div>
                            @endforeach
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="text" name="key[]" id="key" class="form-control" value="" placeholder="key">
                                </div>
                                <div class="col-6">
                                    <input type="text" name="value[]" id="value" class="form-control" value="" placeholder="value">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="flex justify-between">
                            <button type="button" onclick="addRow()" class="btn btn-primary">Add Infor</button>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea id="description" name="description" rows="4" class="form-control cols="50">{{ old('description', $paymentMethod->description) }}</textarea>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('payment_methods.index') }}" class="btn btn-secondary">Cancel</a>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @vite('resources/js/paymentMethod.js')
</x-app-layout>
