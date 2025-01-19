<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function AllPermission()
    {
        $permissions = Permission::all();

        return view('backend.pages.permission.all_permission' , compact('permissions'));
    } // End method


    public function AddPermission()
    {
        return view('backend.pages.permission.add_permission');
    } //End Method

    public function storePermission(Request $request)
    {
        //validation
        $request->validate([
            'permission_name' => 'string|max:200',
        ]);

        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name

        ]);

        $notification = [
            'message'       => 'Permission created successfully',
            'alert-type'    => 'success'
        ];

        return redirect()->route('all.permission')->with($notification);
    } //End  method

    public function EditPermission($id)
    {
        $permission = Permission::findOrFail($id);

        return view('backend.pages.permission.edit_permission' , compact('permission'));
    } //End Permission

    public function UpdatePermission(Request $request)
    {
        //validation
        $request->validate([
            'permission_name' => 'string|max:200',
        ]);

        Permission::find($request->id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name

        ]);

        $notification = [
            'message'       => 'Permission updated successfully',
            'alert-type'    => 'success'
        ];

        return redirect()->route('all.permission')->with($notification);

    } //End mehtod

    public function deletePermission($id)
    {
        Permission::findOrFail($id)->delete();

        $notification = [
            'message'       => 'Permission deleted successfully',
            'alert-type'    => 'success'
        ];

        return redirect()->route('all.permission')->with($notification);

    }
}
