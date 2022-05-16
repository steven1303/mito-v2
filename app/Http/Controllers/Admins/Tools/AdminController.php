<?php

namespace App\Http\Controllers\Admins\Tools;

use App\Models\Role;
use App\Models\Admin;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admins\SettingAjaxController;

class AdminController extends SettingAjaxController
{
    public function profile()
    {
        $role = Role::all();
        $branch = Branch::all();
        $data = [
            'roles' => $role,
            'branches' => $branch,
        ];
        return view('admins.contents.tools.profile')->with($data);
    }

    public function update_profile(Request $request, $id)
    {

        $admin = Admin::find($id);
            if(Auth::user()->can('admin.branch')){
                $admin->id_branch    = $request['branch'];
            }
            if($request->get('password') != NULL || $request->get('password') != "" ){
                $admin->password = Hash::make($request['password']);
            }
            $admin->update();
            return response()
                ->json(['code'=>200,'message' => 'Edit Profile Data Success', 'stat' => 'Success']);

    }
}
