<?php

namespace App\Http\Controllers\Admins\Settings;

use App\Models\Tax;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Settings\TaxStorePostRequest;
use App\Http\Requests\Settings\TaxUpdatePatchRequest;
use App\Http\Controllers\Admins\SettingAjaxController;

class TaxController extends SettingAjaxController
{
    public function index(){
        if(Auth::user()->can('tax.view')){
            $data = [
            ];
            return view('admins.contents.settings.tax')->with($data);
        }
        return view('admins.components.403');
    }

    public function store(TaxStorePostRequest $request){
        if(Auth::user()->can('tax.store')){
            $data = [
                'name' => $request['name'],
                'ppn' => $request['ppn'],
            ];
            $activity = Tax::create($data);
            if ($activity->exists) {
                return response()
                    ->json(['code'=>200,'message' => 'Add new Tax Success', 'stat' => 'Success']);
            } else {
                return response()
                    ->json(['code'=>200,'message' => 'Error Tax Store', 'stat' => 'Error']);
            }
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Tax Access Denied', 'stat' => 'Error']);
    }

    public function edit($id){
        if(Auth::user()->can('tax.update')){
            $data = Tax::findOrFail($id);
            return $data;
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Tax Access Denied', 'stat' => 'Error']);
    }

    public function update(TaxUpdatePatchRequest $request,$id){
        if(Auth::user()->can('tax.update')){
            $data = Tax::find($id);
            $data->name    = $request['name'];
            $data->ppn = $request['ppn'];
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'Edit Tax Success', 'stat' => 'Success']);
        }
        return response()
        ->json(['code'=>200,'message' => 'Error Tax Access Denied', 'stat' => 'Error']);
    }

    public function destroy($id){
        if(Auth::user()->can('tax.delete')){
            Tax::destroy($id);
            return response()
                ->json(['code'=>200,'message' => 'Tax Success Deleted', 'stat' => 'success']);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Tax Access Denied', 'stat' => 'error']);
    }

    public function record(){
        $data = Tax::all();
        $access =  Auth::user();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('tax_percent', function($data){
                $tax_percent = ($data->ppn * 100 ). " %"; 
                return $tax_percent;
            })
            ->addColumn('action', function($data)  use($access){
                $action = "";
                if($access->can('tax.update')){
                    $action .= '<button id="'. $data->id .'" onclick="editForm('. $data->id .')" class="btn btn-info btn-xs"> Edit</button> ';
                }
                if($access->can('tax.delete')){
                    $title = "'".$data->name."'";
                    $action .= '<button id="'. $data->id .'" onclick="deleteData('. $data->id .','.$title.')" class="btn btn-danger btn-xs"> Delete</button>';
                }
                return $action;
            })
            ->rawColumns(['action'])->make(true);
    }
}
