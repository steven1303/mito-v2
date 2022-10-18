<?php

namespace App\Http\Controllers\Admins\Ordering;

use App\Models\Spbd;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\DocNumber;
use App\Http\Controllers\Traits\ValidationSpbd;
use App\Http\Controllers\Traits\StockMasterMovement;
use App\Http\Controllers\Admins\SettingAjaxController;

class SpbdController extends SettingAjaxController
{
    use DocNumber;    
    use ValidationSpbd;    
    use StockMasterMovement;

    public function index()
    {
        if(Auth::user()->can('spbd.view')){
            $data = [];
            return view('admins.contents.ordering.spbd.spbdList')->with($data);
        }
        return view('admins.components.403');
    }

    public function transfer_branch_form($id)
    {
        if(Auth::user()->can('spbd.store')){
            $spbd = Spbd::findOrFail($id);
            $data = [
                'spbd' => $spbd,
            ];
            return view('admins.contents.ordering.spbd.spbdForm')->with($data);
        }
        return view('admins.components.403');
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('spbd.store')){
            $draf = Spbd::where([
                ['status','=', 'Draft'],
            ])->count();

            if($draf > 0){
                return response()->json(['code'=>200,'message' => 'Use the previous Draf SPBD First', 'stat' => 'Warning']);
            }

            $document = Spbd::where([
                ['spbd_no','like', $this->documentFormat('SPBD').'%'],
            ])->count();

            $data = [
                'branch_id' => Auth::user()->branch_id,
                'spbd_no' => $this->documentFormat('SPBD').'/'.sprintf("%03d", $document + 1),
                'status' => 'Draft',
                'username' => Auth::user()->name,
            ];
            $activity = Spbd::create($data);
            if ($activity->exists) {
                return response()->json(['code'=>200,'message' => 'Add new SPBD Success' , 'stat' => 'Success', 'id' => $activity->id, 'process' => 'add']);

            } else {
                return response()->json(['code'=>200,'message' => 'Error SPBD Store', 'stat' => 'Error']);
            }
        }
        return response()->json(['code'=>200,'message' => 'Error SPBD Access Denied', 'stat' => 'Error']);
    }

    public function record(){
        $auth =  Auth::user();
        if(Auth::user()->can('spbd.view')){
            $data = Spbd::latest()->get();
            $access =   $this->accessSpbd( $auth, 'spbd');
            // dd($access);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data)  use($access){
                    $action = $this->buttonAction($data, $access);      
                    return $action;
                })
                ->rawColumns(['action'])->make(true);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Transfer Branch Access Denied', 'stat' => 'Error']);
    }
}
