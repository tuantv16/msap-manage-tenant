@extends('admin.users.layout')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-3">
                <a href="{{route('users.index')}}" class="btn btn-secondary"><i class="fa-solid fa-backward"></i> Back
                    to user list</a>
            </div>
            {{--            @foreach ($errors->all() as $error)--}}
            {{--                <li>{{ $error }}</li>--}}
            {{--            @endforeach--}}
            <form method="post" action="{{route('users.createUser')}}">
                @csrf
                <div class="mb-3">
                    <label for="userName" class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control" id="userName">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="userEmail" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" id="userEmail" aria-describedby="emailHelp">
                    {{--                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>--}}
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Role:</label>
                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                        <input name="roles[]" type="checkbox" value="1" class="btn-check" id="checkAdmin" autocomplete="off">
                        <label class="btn btn-outline-success mr-2" for="checkAdmin">Admin</label>

                        <input name="roles[]" type="checkbox" value="2" class="btn-check" id="checkSale" autocomplete="off">
                        <label class="btn btn-outline-success" for="checkSale">Sale</label>
                    </div>
                    @error('roles')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="userPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="userPassword">
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="userReEnterPassword" class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="userReEnterPassword">
                    @error('confirm_password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection
