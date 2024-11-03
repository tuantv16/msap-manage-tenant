@extends('admin.users.layout')
@section('content')
    @include('layouts.title_content', ['breadcrumb' => 'EXV / Users', 'title' => 'Users Management'])

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session()->has('success'))
                <div class="alert alert-success" id="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                <a href="{{route('users.create')}}" class="btn btn-success">Create new admin user <i
                        class="fa-solid fa-plus"></i></a>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr class="text text-center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>System Roles</th>
                    <th>Created Time</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr class="text-center">
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge bg-warning">{{$role->name}}</span>
                            @endforeach
                        </td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            <a href="{{route('users.show', $user->id)}}" class="btn btn-primary"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            @if(! ($user->id == \Illuminate\Support\Facades\Auth::user()->id))
                                <a href="{{route('users.deleteUser', $user->id)}}"
                                   class="btn btn-danger delete-user-btn"><i class="fa-solid fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
            {{$users->links()}}
        </div>
    </div>

    <script>
        //hide alert session after 2s
        $(document).ready(function () {
            setTimeout(function () {
                $('#success-message').fadeOut('slow');
            }, 2500);
        });
    </script>
@endsection
