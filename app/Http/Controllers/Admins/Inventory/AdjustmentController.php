<?php

namespace App\Http\Controllers\Admins\Inventory;

use App\Models\Adjustment;
use Illuminate\Http\Request;
use App\Models\AdjustmentDetail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\DocNumber;
use App\Http\Controllers\Traits\ActionButton;
use App\Http\Controllers\Traits\ValidationAdjustment;
use App\Http\Controllers\Admins\SettingAjaxController;

class AdjustmentController extends SettingAjaxController
{
    use ActionButton;
    use ValidationAdjustment;
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
                ['status','=', 'Draft'],
                ['branch_id','=', Auth::user()->branch_id]
            ])->count();

            if($draf > 0){
                return response()->json(['code'=>200,'message' => 'Use the previous Draf Adjustment First', 'stat' => 'Warning']);
            }
            $data = [
                'adj_no' => $this->documentFormat('ADJ').'/'.sprintf("%03d", $draf + 1),
                'branch_id' => Auth::user()->branch_id,
                'username' => Auth::user()->name,
                'status' => 'Draft',
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

    public function store_detail(Request $request, $id)
    {
        if(Auth::user()->can('adjustment.store')){
            $data = [
                'id_branch' => Auth::user()->id_branch,
                'adj_id' => $id,
                'stock_master_id' => $request['stock_master'],
                'in_qty' => $request['in_qty'],
                'out_qty' => $request['out_qty'],
                'harga_modal' => $request['harga_modal'],
                'harga_jual' => $request['harga_jual'],
                'keterangan' => $request['keterangan'],
            ];

            $activity = AdjustmentDetail::create($data);

            if ($activity->exists) {
                return response()
                    ->json(['code'=>200,'message' => 'Add new item Adjustment Success', 'stat' => 'Success', 'process' => 'update']);

            } else {
                return response()
                    ->json(['code'=>200,'message' => 'Error item Adjustment Store', 'stat' => 'Error']);
            }
        }
        return response()->json(['code'=>200,'message' => 'Error Adjustment Access Denied', 'stat' => 'Error']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_detail($id)
    {
        if(Auth::user()->can('adjustment.update')){
            $data = AdjustmentDetail::with('stock_master')->findOrFail($id);
            return $data;
        }
        return response()->json(['code'=>200,'message' => 'Error Adjustment Access Denied', 'stat' => 'Error']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_detail(Request $request, $id)
    {
        if(Auth::user()->can('adjustment.update')){
            $data = AdjustmentDetail::find($id);
            $data->stock_master_id    = $request['stock_master'];
            $data->in_qty    = $request['in_qty'];
            $data->out_qty    = $request['out_qty'];
            $data->harga_modal    = $request['harga_modal'];
            $data->harga_jual    = $request['harga_jual'];
            $data->keterangan    = $request['keterangan'];
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'Edit Item Adjustment Success', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error Adjustment Access Denied', 'stat' => 'Error']);
    }

    public function destroy($id)
    {
        if(Auth::user()->can('adjustment.delete')){
            Adjustment::destroy($id);
            return response()->json(['code'=>200,'message' => 'Adjustment Success Deleted', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error Adjustment Access Denied', 'stat' => 'Error']);
    }

    public function destroy_detail($id)
    {
        if(Auth::user()->can('adjustment.delete')){
            AdjustmentDetail::destroy($id);
            return response()->json(['code'=>200,'message' => 'Adjustment Detail Success Deleted', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error Adjustment Access Denied', 'stat' => 'Error']);
    }

    public function record(){
        $auth =  Auth::user();
        if(Auth::user()->can('adjustment.view')){
            $data = Adjustment::latest()->get();
            $access =   $this->accessAdjustment( $auth, 'adjustment');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data)  use($access){
                    $adj_detail = "javascript:ajaxLoad('".route('adj.form', ['id' => $data->id])."')";
                    // dd($adj_detail);
                    $action = $this->buttonAction($data, $access);      
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
            $data = AdjustmentDetail::with(['stock_master'])->where('adj_id', '=', $id)->get();
            $access =   $this->accessAdjustment( $auth, 'adjustment');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data)  use($access){
                    $action = $this->buttonEditDelete($data, $access, $data->stock_master->stock_no);       
                    return $action;
                })
                ->rawColumns(['action'])->make(true);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Adjustment Access Denied', 'stat' => 'Error']);
    }
}
