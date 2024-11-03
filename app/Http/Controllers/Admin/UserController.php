<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\ResetUserPassword;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function index(){
        $users = $this->userService->getListUserAdmin();
        return view('admin.users.index', compact('users'));
    }

    public function create(){
        return view('admin.users.create');
    }

    public function createUser(CreateUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->userService->create($request);
            DB::Commit();
            return redirect()->route('users.index')->with('success', 'User created successfully');
        } catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'User not created');
        }
    }

    public function show($id)
    {
        $user = $this->userService->getById($id);
        return view('admin.users.detail', compact('user'));
    }

    public function updateUser(UpdateUserRequest $request,$id){
        try {
            DB::beginTransaction();
            $this->userService->update($request, $id);
            DB::Commit();
            return redirect()->route('users.index')->with('success', 'User updated successfully');
        } catch (\Exception $exception){
            DB::RollBack();
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'User not updated');
        }
    }

    public function resetPassword(ResetUserPassword $request,$id)
    {
        try {
            $this->userService->resetPassword($request, $id);
            return redirect()->route('users.index')->with('success', 'User password updated successfully');
        } catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'Failed to reset password');
        }
    }

    public function deleteUser($id){
        try {
            DB::beginTransaction();
            $this->userService->delete($id);
            DB::Commit();
            return redirect()->route('users.index')->with('success', 'User deleted successfully');
        } catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'User not deleted');
        }
    }
}
