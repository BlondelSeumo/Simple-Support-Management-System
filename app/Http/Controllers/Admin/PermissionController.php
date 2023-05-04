<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends BackendController
{
    public function __construct()
    {
        $this->middleware(['permission:permission'])->only('index');
    }

    public function index($id = 1)
    {
        $role = Role::findOrFail($id);

        $permissionArray      = [];
        $listPermissionsArray = [];
        $permissions          = Permission::get();
        if (count($permissions)) {
            foreach ($permissions as $permission) {
                if ((strpos($permission->name, '_create') == false) && (strpos($permission->name, '_edit') == false) && (strpos($permission->name, '_show') == false) && (strpos($permission->name, '_destroy') == false)) {
                    $listPermissionsArray[$permission->id] = $permission;
                }
                $permissionArray[$permission->name] = $permission->id;
            }
        }

        $this->data['role']            = $role;
        $this->data['roles']           = Role::get();
        $this->data['permissions']     = $role->permissions->pluck('id', 'id');
        $this->data['selectRoleID']    = $id;
        $this->data['permissionArray'] = $permissionArray;
        $this->data['permissionList']  = $listPermissionsArray;

        return view('backend.permission.index', $this->data);
    }

    public function savePermission(Request $request, $id)
    {
        if ($_POST) {
            $permissions = $request->all();
            unset($permissions['_token']);
            $permissions = array_values($permissions);

            $role       = Role::find($id);
            $permission = Permission::whereIn('id', $permissions)->get();
            $role->syncPermissions($permission);

            return redirect(route('admin.permission.index', $role))->withSuccess('The Permission Updated Successfully');
        }
        return redirect(route('admin.permission.index'));
    }
}
