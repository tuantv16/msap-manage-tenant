<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permissions\PermissionRequest;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PermissionController extends Controller
{

    public $permissionService;
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $permissions = $this->permissionService->search($params);
        return view('admin.manages.permissions.index', compact('permissions'));
    }

    public function create() {
        return view('admin.manages.permissions.create');
    }

    /**
     * create new permission
     *
     * @param Request $request
     * @return void
     */
    public function store(PermissionRequest $request) {
        try {
            $params = $request->validated();
            $this->permissionService->save($params);
            return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

     /**
     * edit permission
     *
     * @param [int] $id
     * @return void
     */
    public function edit($id) {
        $permission = $this->permissionService->findById($id);
        return view('admin.manages.permissions.edit', compact('permission'));
    }

    /**
     * Update permission by Id
     *
     * @param PermissionRequest $request
     * @param [type] $id
     * @return void
     */
    public function update(PermissionRequest $request, $id)
    {
        try {
            $params = $request->validated();
            $this->permissionService->update($id, $params);
            return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully.');
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
            $permission = $this->permissionService->findById($id);
            return view('admin.manages.permissions.show', compact('permission'));
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
    public function destroy($id)
    {
        try {
            $this->permissionService->delete($id);
            return redirect()->route('admin.permissions.index')->with('success', 'Permission delete successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }
   
}