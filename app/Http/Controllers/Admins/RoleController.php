<?php

namespace App\Http\Controllers\Admins;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admins\SettingAjaxController;

class RoleController extends SettingAjaxController
{
    public function index()
    {
        if(Auth::user()->can('role.view')){
            $data = [];
            return view('admins.contents.role')->with($data);
        }
        return view('admins.components.403');
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('role.store')){
            $data = [
                'role_name' => $request['role_name'],
            ];
            $activity = Role::create($data);
            if ($activity->exists) {
                return response()
                    ->json(['code'=>200,'message' => 'Add new Roles Success', 'stat' => 'Success']);
            } else {
                return response()
                    ->json(['code'=>200,'message' => 'Error Roles Store', 'stat' => 'Error']);
            }
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Role Access Denied', 'stat' => 'Error']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->can('role.permission')){
            $roles = Role::find($id);
            $permission = Permission::all();
            $data = [
                'role'          => $roles,
                'permissions'    => $permission,
            ];
            return view('admins.contents.role_permission')->with($data);
        }
        return view('admins.components.403');
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
        if(Auth::user()->can('role.update')){
            $data = Role::find($id);
            $data->role_name    = $request['role_name'];
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'Edit Roles Success', 'stat' => 'Success']);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Role Access Denied', 'stat' => 'Error']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->can('role.update')){
            $data = Role::findOrFail($id);
            return $data;
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Role Access Denied', 'stat' => 'Error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('role.delete')){
            Role::destroy($id);
            return response()
                ->json(['code'=>200,'message' => 'Roles Success Deleted', 'stat' => 'Success']);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Role Access Denied', 'stat' => 'Error']);
    }

    public function recordRole(){
        $data = Role::all();
        $access =  Auth::user();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data) use($access){
                $action = "";
                $title = "'".$data->role_name."'";
                $sidebar = "javascript:ajaxLoad('".route('role.show', $data->id)."')";
                if($access->can('role.update')){
                    $action .= '<button id="'. $data->id .'" onclick="editForm('. $data->id .')" class="btn btn-info btn-xs"> Edit</button> ';
                }
                if($access->can('role.delete')){
                    $action .= '<button id="'. $data->id .'" onclick="deleteData('. $data->id .','.$title.')" class="btn btn-danger btn-xs"> Delete</button> ';
                }
                if($access->can('role.permission')){
                    $action .= '<a href="'.$sidebar.'" class="btn btn-primary btn-xs"> Permission</a> ';  
                }              
                return $action;
            })
            ->rawColumns(['action'])->make(true);
    }

    public function updatePermission(Request $request)
    {
        if(Auth::user()->can('role.permission')){
            $roles = Role::find($request->id);
            $roles->update();
            $roles->permissions()->sync($request->permission);
            return response()
                ->json(['code'=>200,'message' => 'Update Access Success', 'stat' => 'Success']);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Role Access Denied', 'stat' => 'Error']);
    }
}
