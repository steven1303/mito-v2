<?php

namespace App\Http\Controllers\Admins\Settings;

use App\Models\Tax;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\ActionButton;
use App\Http\Requests\Settings\TaxStorePostRequest;
use App\Http\Requests\Settings\TaxUpdatePatchRequest;
use App\Http\Controllers\Admins\SettingAjaxController;

class TaxController extends SettingAjaxController
{
    use ActionButton;
    
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
        $auth =  Auth::user();
        if($auth->can('tax.view')){
            $data = Tax::all();
            $access =  $this->accessEditDelete( $auth, 'tax');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data)  use($access){                    
                    $action = $this->buttonEditDelete($data, $access, 'tax');
                    return $action;
                })
                ->rawColumns(['action'])
                ->only(['name','ppn','tax_percent','action'])->make(true);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Tax Access Denied', 'stat' => 'Error']);
    }
}
