<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Roles\RoleRequest;
use App\Services\RoleService;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    public $roleService;
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function create()
    {
        return view('admin.manages.roles.form');
    }

    /**
     * create new role function
     *
     * @param RoleRequest $request
     * @return void
     */
    public function store(RoleRequest $request)
    {
        $params = $request->validated();

        try {
            $this->roleService->save($params);
            return redirect()->route('admin.manages.roles.form')->with('success', 'Role created successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Update role by Id
     *
     * @param RoleRequest $request
     * @param [int] $id
     * @return void
     */
    public function update(RoleRequest $request, $id)
    {
        try {
            $params = $request->validated();
            $this->roleService->update($id, $params);
            return redirect()->back()->with('success', 'Role updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

      /**
     * show function
     *
     * @param [int] $id
     * @return void
     */
    public function show($id)
    {
        try {
            $permission = $this->roleService->findById($id);
            return view('admin.roles.show', compact('permission'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * delete function
     *
     * @param [int] $id
     * @return void
     */
    public function delete($id)
    {
        try {
            return $this->roleService->delete($id);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

}