<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function allPermission(){
        $permissions = Permission::all();
        return view('admin.permission.all_permission',compact('permissions'));
    }

    public function storePermission(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'group_name' => 'required'
        ]);

        Permission::insert([
            'name' => $request->name,
            'group_name' => $request->group_name,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('message','Permission Inserted Successfully');
    }

    public function editPermission($id){
        $edit_data = Permission::find($id);
        return view('admin.permission.edit_permission',compact('edit_data'));
    }

    public function updatePermission(Request $request,$id){
        $update_data = Permission::find($id);
        $update_data->name = $request->name;
        $update_data->group_name = $request->group_name;
        $update_data->updated_at = Carbon::now();
        $update_data->update();

        return redirect()->route('all.permission')->with('message','Permission Inserted Successfully');
    }

    public function deletePermission($id){
        $delete_data = Permission::find($id);
        $delete_data->delete();

        return redirect()->back()->with('warning','Permission Deleted Successfully');
    }

    public function viewRoles(){
        $roles = Role::all();
        return view('admin.role.role',compact('roles'));
    }

    public function addRoles(){
        return view('admin.role.add_role');
    }

    public function storeRoles(Request $request){
        $this->validate($request,[
            'name' => 'required'
        ]);

        Role::insert([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('view.roles')->with('message','Role Inserted Successfully');
    }

    public function editRoles($id){
        $edit_data = Role::find($id);

        return view('admin.role.role_edit',compact('edit_data'));
    }

    public function updateRoles(Request $request,$id){
        $update_data = Role::find($id);
        $update_data->name = $request->name;
        $update_data->updated_at = Carbon::now();
        $update_data->update();

        return redirect()->route('view.roles')->with('message','Role Updated Successfully');
    }

    public function deleteRoles($id){
        $delete_data = Role::find($id);
        $delete_data->delete();

        return redirect()->back()->with('warning','Role Deleted Successfully');
    }

    public function rolesPermissionAdd(){
        $roles = Role::all();
        $permission = Permission::all();
        $data = User::getAllRole();
        return view('admin.role.add_role_permission',compact('roles','data','permission'));
    }

    public function rolesPermissionStore(Request $request){
        $this->validate($request,[
            'role_id' => 'required',
            'permission_id' => 'required'
        ]);

        $count = count($request->permission_id);

        for ( $i=0; $i<$count; $i++ ){
            DB::table('role_has_permissions')->insert([
                'role_id' => $request->role_id,
                'permission_id' => $request->permission_id[$i],
            ]);
        }

        return redirect()->route('role.permission.view')->with('warning','Role and Permission Added Successfully');
    }


    public function rolesPermissionView(){
        $roles = Role::all();
        return view('admin.role.role_permission',compact('roles'));
    }


















}
