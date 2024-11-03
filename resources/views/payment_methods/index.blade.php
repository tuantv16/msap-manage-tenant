<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payment Methods List') }}
        </h2>
    </x-slot>

    <div class="container mt-5">
        @include('layouts.title_content', ['breadcrumb' => 'Home / Payment Methods', 'title' => 'Payment Methods'])
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('payment_methods.create') }}" class="btn btn-primary">Create New Payment Method</a>
        </div>

        <div class="table">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Infor</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Create date</th>
                    <th>Last update date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($paymentMethods as $paymentMethod)
                    <tr>
                        <td>{{ $paymentMethod->id }}</td>
                        <td>{{ $paymentMethod->name }}</td>
                        <td>
                            @if (isset($paymentMethod['infor']))
                                @foreach ($paymentMethod['infor'] as $key => $value)
                                    <p> {{ $key }} : {{ $value }} </p>
                                @endforeach
                            @endif
                        </td>
                        <td>{{ $paymentMethod->description }}</td>
                        <td>
                            <span class="badge {{ $paymentMethod->status === 0 ? 'bg-danger' : 'bg-success' }}">
                                {{ $paymentMethod->status === 0 ? 'Deactive' : 'Active' }}
                            </span>
                        </td>
                        <td>{{ $paymentMethod->created_at }}</td>
                        <td>{{ $paymentMethod->updated_at }}</td>
                        <td>
                            <a href="#" class="blue-color">Detail</a> |
                            <a class="blue-color" href="{{ route('payment_methods.edit', $paymentMethod->id) }}">Edit</a> |
                            <a href="#" class="blue-color" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $paymentMethod->id }}" >Delete</a> 
                            {{-- Popup Delete --}}
                            <div class="modal fade" id="deleteModal{{ $paymentMethod->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $paymentMethod->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $paymentMethod->id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this Payment Method?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('payment_methods.destroy', $paymentMethod->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>



</x-app-layout>
