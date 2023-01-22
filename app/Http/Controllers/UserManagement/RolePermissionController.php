<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function __invoke(Request $request, $id)
    {
        $role = Role::find(Crypt::decrypt($id));
        // dd($role);

        $ids = collect($request->permissions);
        $role->syncPermissions($ids);

        return redirect()->route('user-management.role.index')->with('success', 'Role Permission Updated');
    }
}
