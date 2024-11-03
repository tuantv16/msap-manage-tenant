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
            <div class="row">
                <div class="col-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="basic-info-list" data-bs-toggle="list" href="#basic-info" role="tab" aria-controls="list-home"><i class="fa-solid fa-user"></i> Basic Information</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile"><i class="fa-solid fa-key"></i> Advance Information</a>
                    </div>
                </div>
                <div class="col-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-info-list">
                            <form method="post" action="{{route('users.update', $user->id)}}">
                                @csrf
                                <div class="mb-3">
                                    <label for="userName" class="form-label">Name:</label>
                                    <input value="{{$user->name}}" type="text" name="name" class="form-control" id="userName">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="userEmail" class="form-label">Email:</label>
                                    <input type="email" value="{{$user->email}}" name="email" class="form-control" id="userEmail" aria-describedby="emailHelp">
                                    {{--                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>--}}
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Role:</label>
                                    <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                        <input name="roles[]" type="checkbox" value="1" class="btn-check" id="checkAdmin" {{ $user->roles->contains('id', config('const.users.roles.admin')) ? 'checked' : '' }} autocomplete="off">
                                        <label class="btn btn-outline-success mr-2" for="checkAdmin">Admin</label>

                                        <input name="roles[]" type="checkbox" value="2" class="btn-check" id="checkSale" {{ $user->roles->contains('id', config('const.users.roles.sale')) ? 'checked' : '' }} autocomplete="off">
                                        <label class="btn btn-outline-success" for="checkSale">Sale</label>
                                    </div>
                                    @error('roles')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Update basic information</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                            <form class="mt-4" method="post" action="{{route('users.resetPassword', $user->id)}}">
                                @csrf
                                <div class="mb-3">
                                    <label for="userPassword" class="form-label">New Password</label>
                                    <input type="password" value="" name="password" class="form-control" id="userPassword">
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="userReEnterPassword" class="form-label">Confirm New Password</label>
                                    <input value="" type="password" name="confirm_password" class="form-control" id="userReEnterPassword">
                                    @error('confirm_password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
