<?php

namespace App\Http\Controllers\Admins\Inventory;

use App\Models\Adjustment;
use Illuminate\Http\Request;
use App\Models\AdjustmentDetail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\DocNumber;
use App\Http\Controllers\Traits\ActionButton;
use App\Http\Controllers\Admins\SettingAjaxController;

class AdjustmentController extends SettingAjaxController
{
    use ActionButton;
    use DocNumber;

    public function index()
    {
        if(Auth::user()->can('adjustment.view')){
            $data = [];
            return view('admins.contents.inventory.adjustment.adjustmentList')->with($data);
        }
        return view('admins.components.403');
    }

    public function create_adjustment_form($id)
    {
        if(Auth::user()->can('adjustment.store')){
            $adj = Adjustment::findOrFail($id);
            $data = [
                'adj' => $adj
            ];
            return view('admins.contents.inventory.adjustment.adjustmentForm')->with($data);
        }
        return view('admins.components.403');
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('adjustment.store')){
            $draf = Adjustment::where([
                ['status','=', 'Draf'],
                ['branch_id','=', Auth::user()->branch_id]
            ])->count();

            if($draf > 0){
                return response()->json(['code'=>200,'message' => 'Use the previous Draf Adjustment First', 'stat' => 'Warning']);
            }
            $data = [
                'adj_no' => $this->documentFormat('ADJ').'/'.$draf + 1,
                'branch_id' => Auth::user()->branch_id,
                'username' => Auth::user()->name,
                'status' => 'Draf',
            ];
            $activity = Adjustment::create($data);
            if ($activity->exists) {
                return response()->json(['code'=>200,'message' => 'Add new Adjustment Success' , 'stat' => 'Success', 'id' => $activity->id, 'process' => 'add']);

            } else {
                return response()->json(['code'=>200,'message' => 'Error Adjustment Store', 'stat' => 'Error']);
            }
        }
        return response()->json(['code'=>200,'message' => 'Error Adjustment Access Denied', 'stat' => 'Error']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('adjustment.delete')){
            Adjustment::destroy($id);
            return response()->json(['code'=>200,'message' => 'Adjustment Success Deleted', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error Adjustment Access Denied', 'stat' => 'Error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_detail($id)
    {
        AdjustmentDetail::destroy($id);
        return response()
            ->json(['code'=>200,'message' => 'Adjustment Detail Success Deleted', 'stat' => 'Success']);
    }

    public function record(){
        $auth =  Auth::user();
        if(Auth::user()->can('adjustment.view')){
            $data = Adjustment::latest()->get();
            $access =   $this->accessEditDelete( $auth, 'adjustment');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data)  use($access){
                    $adj_detail = "javascript:ajaxLoad('".route('adj.form', ['id' => $data->id])."')";
                    // dd($adj_detail);
                    $action = $this->buttonEditDelete($data, $access);                    
                    $action .= '<a href="'.$adj_detail.'" class="btn btn-success btn-xs"> Open</a> ';
                    return $action;
                })
                ->rawColumns(['action'])->make(true);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Adjustment Access Denied', 'stat' => 'Error']);
    }

    public function record_detail($id){
        $auth =  Auth::user();
        if(Auth::user()->can('adjustment.view')){
            $data = AdjustmentDetail::where('adj_id', '=', $id)->get();
            $access =   $this->accessEditDelete( $auth, 'adjustment');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data)  use($access){
                    $adj_detail = "javascript:ajaxLoad('".route('adj.form', ['id' => $data->id])."')";
                    // dd($adj_detail);
                    $action = $this->buttonEditDelete($data, $access);                    
                    $action .= '<a href="'.$adj_detail.'" class="btn btn-success btn-xs"> Open</a> ';
                    return $action;
                })
                ->rawColumns(['action'])->make(true);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Adjustment Access Denied', 'stat' => 'Error']);
    }
}
