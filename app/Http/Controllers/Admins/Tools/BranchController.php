<?php

namespace App\Http\Controllers\Admins\Tools;

use App\Models\Branch;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Http\Controllers\Traits\ActionButton;
use App\Http\Requests\Tools\BranchStorePostRequest;
use App\Http\Requests\Tools\BranchUpdatePatchRequest;
use App\Http\Controllers\Admins\SettingAjaxController;

class BranchController extends SettingAjaxController
{
    use ActionButton;
    
    public function index()
    {
        if(Auth::user()->can('branch.view')){
            $data = [
            ];
            return view('admins.contents.tools.branch')->with($data);
        }
        return view('admins.components.403');
        
    }

    public function store(BranchStorePostRequest $request)
    {
        if(Auth::user()->can('branch.store')){
            $data = [
                'name' => $request['name'],
                'city' => $request['city'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'npwp' => $request['npwp'],
            ];
            $activity = Branch::create($data);
            if ($activity->exists) {
                return response()
                    ->json(['code'=>200,'message' => 'Add new Branch Success', 'stat' => 'Success']);
            } else {
                return response()
                    ->json(['code'=>200,'message' => 'Error Branch Store', 'stat' => 'Error']);
            }
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Branch Access Denied', 'stat' => 'Error']);
    }

    public function edit($id)
    {
        if(Auth::user()->can('branch.update')){
            $data = Branch::findOrFail($id);
            return $data;
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Branch Access Denied', 'stat' => 'Error']);
    }

    public function update(BranchUpdatePatchRequest $request, $id)
    {
        if(Auth::user()->can('branch.update')){
            $data = Branch::find($id);
            $data->name    = $request['name'];
            $data->city = $request['city'];
            $data->address    = $request['address'];
            $data->phone    = $request['phone'];
            $data->npwp    = $request['npwp'];
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'Edit Branch Success', 'stat' => 'Success']);
        }
        return response()
        ->json(['code'=>200,'message' => 'Error Branch Access Denied', 'stat' => 'Error']);
    }

    public function destroy($id)
    {
        if(Auth::user()->can('branch.delete')){
            Branch::destroy($id);
            return response()
                ->json(['code'=>200,'message' => 'Branch Success Deleted', 'stat' => 'success']);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Branch Access Denied', 'stat' => 'error']);
    }

    public function record(){
        $auth =  Auth::user();
        if($auth->can('branch.view')){
            $data = Branch::all();
            $access =  $this->accessEditDelete( $auth, 'branch');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data)  use($access){
                    $action = $action = $this->buttonEditDelete($data, $access);
                    return $action;
                })
                ->rawColumns(['action'])
                ->only(['name','city','npwp','phone','action'])->make(true);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Branch Access Denied', 'stat' => 'Error']);
    }
}
