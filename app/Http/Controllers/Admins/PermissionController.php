<?php

namespace App\Http\Controllers\Admins;

use App\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admins\SettingAjaxController;

class PermissionController extends SettingAjaxController
{
    public function index()
    {
        if(Auth::user()->can('permission.view')){
            $data = [];
            return view('admins.contents.permission')->with($data);
        }
        return view('admins.components.403');
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('permission.store')){
            $data = [
                'name' => $request['permission_name'],
                'for' => $request['permission_for'],
                'stat' => $request['status'],
            ];

            $activity = Permission::create($data);

            if ($activity->exists) {
                return response()
                    ->json(['code'=>200,'message' => 'Add new Permission Success', 'stat' => 'Success']);

            } else {
                return response()
                    ->json(['code'=>200,'message' => 'Error Permission Store', 'stat' => 'Error']);
            }
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Permission Access Denied', 'stat' => 'Error']);
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
        if(Auth::user()->can('permission.update')){
            $data = Permission::find($id);
            $data->name    = $request['permission_name'];
            $data->for    = $request['permission_for'];
            $data->stat    = $request['status'];
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'Edit Permission Success', 'stat' => 'Success']);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Permission Access Denied', 'stat' => 'Error']);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->can('permission.update')){
            $data = Permission::findOrFail($id);
            return $data;
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Permission Access Denied', 'stat' => 'Error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('permission.delete')){
            Permission::destroy($id);
            return response()
                ->json(['code'=>200,'message' => 'Permission Success Deleted', 'stat' => 'Success']);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Permission Access Denied', 'stat' => 'Error']);
    }

    public function recordPermission(){
        $data = Permission::all();
        $access =  Auth::user();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data) use($access){
                $action = "";
                $title = "'".$data->name."'";
                if($access->can('permission.update')){
                    $action .= '<button id="'. $data->id .'" onclick="editForm('. $data->id .')" class="btn btn-info btn-xs"> Edit</button> ';  
                }
                if($access->can('permission.delete')){            
                    $action .= '<button id="'. $data->id .'" onclick="deleteData('. $data->id .','.$title.')" class="btn btn-danger btn-xs"> Delete</button>';      
                }          
                return $action;
            })
            ->rawColumns(['action'])->make(true);        
    }
}
