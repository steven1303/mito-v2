<?php

namespace App\Http\Controllers\Admins;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Admins\SettingAjaxController;

class AdminController extends SettingAjaxController
{
    public function index()
    {
        if(Auth::user()->can('admin.view')){
            $role = Role::all();
            $data = [
                'roles' => $role,
            ];
            return view('admins.contents.admin')->with($data);
        }
        return view('admins.components.403');
    }

    public function recordAdmin(){
        $admin = Admin::all();
        $access =  Auth::user();
        return DataTables::of($admin)
            ->addIndexColumn()
            ->addColumn('role_name', function($admin){
                return $admin->roles->role_name;
            })
            ->addColumn('action', function($admin)  use($access){
                $action = "";
                $title = "'".$admin->username."'";
                if($access->can('admin.update')){
                    $action .= '<button id="'. $admin->id .'" onclick="editForm('. $admin->id .')" class="btn btn-info btn-xs"> Edit</button> ';
                }
                if($access->can('admin.delete')){
                    if($admin->id != 1){
                        $action .= '<button id="'. $admin->id .'" onclick="deleteData('. $admin->id .','.$title.')" class="btn btn-danger btn-xs"> Delete</button>';
                    }
                }
                return $action;
            })
            ->rawColumns(['action'])->make(true);
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('admin.store')){
            $data = [
                'name' => $request['nama'],
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'role_id' => $request['role'],
            ];
            $activity = Admin::create($data);
            if ($activity->exists) {
                return response()
                    ->json(['code'=>200,'message' => 'Add new Admin Success', 'stat' => 'Success']);
            } else {
                return response()
                    ->json(['code'=>200,'message' => 'Error Admin Store', 'stat' => 'Error']);
            }
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Admin Access Denied', 'stat' => 'Error']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->can('admin.update')){
            $admin = Admin::find($id);
            if($admin->id != 1 && Auth::user()->id != 1 ){
                $admin->name    = $request['nama'];
                $admin->username = $request['username'];
                $admin->email    = $request['email'];
                $admin->role_id    = $request['role'];
                if($request->get('password') != NULL || $request->get('password') != "" ){
                    $admin->password = Hash::make($request['password']);
                }
                $admin->update();
                return response()
                    ->json(['code'=>200,'message' => 'Edit Admin Success', 'stat' => 'Success']);
            }elseif( Auth::user()->id == 1){
                $admin->name    = $request['nama'];
                $admin->username = $request['username'];
                $admin->email    = $request['email'];
                $admin->role_id    = $request['role'];
                if($request->get('password') != NULL || $request->get('password') != "" ){
                    $admin->password = Hash::make($request['password']);
                }
                $admin->update();
                return response()
                    ->json(['code'=>200,'message' => 'Edit Administrator update password Success', 'stat' => 'Success']);
            }
            return response()
            ->json(['code'=>200,'message' => 'Error Administrator Access Denied', 'stat' => 'Error']);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Admin Access Denied', 'stat' => 'Error']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->can('admin.update')){
            $admin = Admin::findOrFail($id);
            return $admin;
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Admin Access Denied', 'stat' => 'Error']);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('admin.delete')){
            $admin = Admin::findOrFail($id);
            if($admin->id != 1 ){
                Admin::destroy($id);
            return response()
                ->json(['code'=>200,'message' => 'Admin Success Deleted', 'stat' => 'Success']);
            }
            return response()
            ->json(['code'=>200,'message' => 'Error Administrator cannot deleted', 'stat' => 'Error']);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Admin Access Denied', 'stat' => 'Error']);
    }
}
