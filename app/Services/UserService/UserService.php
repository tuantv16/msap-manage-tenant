<?php

namespace App\Services\UserService;

use App\Repositories\Users\UserRepositoryInterface;
use App\Services\BaseService;
use App\Models\Role;
use App\Repositories\UserRepository\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }

    public function getById($id)
    {
        return $this->userRepository->find($id);
    }

    public function create($request)
    {
        $params = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $user =  $this->userRepository->create($params);

        $user->roles()->attach($request['roles']);
        return true;
    }

    public function update($request, $id)
    {
        $params = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        $user =  $this->userRepository->update($params, $id);
        $user->roles()->sync($request['roles']);
        return true;
    }

    public function resetPassword($request,$id)
    {
        $params = [
            'password' => Hash::make($request->password)
        ];

        return $this->userRepository->update($params, $id);
    }

    public function delete($id)
    {
        $user = $this->userRepository->find($id);
        $user->roles()->detach();
        return $this->userRepository->delete($id);
    }

    public function getListUserAdmin()
    {
        $perPage = config('const.users.user_per_page');
        return $this->userRepository->getAdminUsers($perPage);
    }

    public function getListSales()
    {
        $perPage = config('const.users.user_per_page');
        return $this->userRepository->getSaleUsers($perPage);
    }
    public function search($perPage = 10, $columns = ['*'])
    {
        return $this->userRepository->paginate($perPage, $columns);
    }
}
