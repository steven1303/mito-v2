<?php

namespace App\Http\Controllers\Admins\Ordering;

use App\Models\PoStock;
use Illuminate\Http\Request;
use App\Models\PoStockDetail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\DocNumber;
use App\Http\Controllers\Traits\ValidationPoStock;
use App\Http\Controllers\Traits\StockMasterMovement;
use App\Http\Controllers\Admins\SettingAjaxController;
use App\Http\Requests\Ordering\PoStockStorePostRequest;
use App\Http\Requests\Ordering\PoStockDetailStorePostRequest;

class PoStockController extends SettingAjaxController
{
    use DocNumber;    
    use ValidationPoStock;
    use StockMasterMovement;

    public function index()
    {
        if(Auth::user()->can('po.stock.view')){
            $data = [];
            return view('admins.contents.ordering.poStock.poStockList')->with($data);
        }
        return view('admins.components.403');
    }

    public function po_stock_form($id)
    {
        if(Auth::user()->can('po.stock.store')){
            $po_stock = PoStock::spbdDetail()->findOrFail($id);
            $data = [
                'po_stock' => $po_stock,
            ];
            return view('admins.contents.ordering.poStock.poStockForm')->with($data);
        }
        return view('admins.components.403');
    }

    public function store(PoStockStorePostRequest $request)
    {
        if(Auth::user()->can('po.stock.store')){
            $draf = PoStock::where([
                ['status','=', 'Draft'],
            ])->count();

            if($draf > 0){
                return response()->json(['code'=>200,'message' => 'Use the previous Draf PoStock First', 'stat' => 'Warning']);
            }

            $document = PoStock::where([
                ['po_no','like', $this->documentFormat('POS').'%'],
            ])->count();

            $data = [
                'branch_id' => Auth::user()->branch_id,
                'po_no' => $this->documentFormat('POS').'/'.sprintf("%03d", $document + 1),
                'spbd_id' => $request['spbd'],
                'status' => 'Draft',
                'username' => Auth::user()->name,
            ];
            $activity = PoStock::create($data);
            if ($activity->exists) {
                return response()->json(['code'=>200,'message' => 'Add new SPBD Success' , 'stat' => 'Success', 'id' => $activity->id, 'process' => 'add']);

            } else {
                return response()->json(['code'=>200,'message' => 'Error SPBD Store', 'stat' => 'Error']);
            }
        }
        return response()->json(['code'=>200,'message' => 'Error SPBD Access Denied', 'stat' => 'Error']);
    }

    public function store_detail(PoStockDetailStorePostRequest $request, $id)
    {
        if(Auth::user()->can('po.stock.store')){
            $data = [
                'branch_id' => Auth::user()->branch_id,
                'po_id' => $id,
                'spbd_detail_id' => $request['spbd_detail_id'],
                'stock_master_id' => $request['stock_master_id'],
                'qty' => $request['spbd_qty'],
                'price' => $request['price'],
                'disc' => $request['disc'],
                'keterangan' => $request['keterangan'],
                'status' => 'Draft',
            ];

            $activity = PoStockDetail::create($data);


            if ($activity->exists) {
                return response()
                    ->json(['code'=>200,'message' => 'Add new item PO Stock Success', 'stat' => 'Success', 'process' => 'update']);

            } else {
                return response()
                    ->json(['code'=>200,'message' => 'Error item PO Stock Store', 'stat' => 'Error']);
            }
        }
        return response()
            ->json(['code'=>200,'message' => 'Error PO Stock Access Denied', 'stat' => 'Error']);
    }

    public function destroy($id)
    {
        if(Auth::user()->can('po.stock.delete')){
            PoStock::destroy($id);
            return response()->json(['code'=>200,'message' => 'Po Stock Success Deleted', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error Po Stock Access Denied', 'stat' => 'Error']);
    }

    public function destroy_detail($id)
    {
        if(Auth::user()->can('po.stock.delete')){
            PoStockDetail::destroy($id);
            return response()->json(['code'=>200,'message' => 'Po Stock Item Success Deleted', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error Po Stock Access Denied', 'stat' => 'Error']);
    }

    public function record(){
        $auth =  Auth::user();
        if(Auth::user()->can('po.stock.view')){
            $data = PoStock::spbdDetail()->latest()->get();
            $access =   $this->accessPoStock( $auth, 'po.stock');
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
            ->json(['code'=>200,'message' => 'Error Po Stock Access Denied', 'stat' => 'Error']);
    }

    public function record_detail($id, $status = NULL){
        $auth =  Auth::user();
        if($auth->canany(['po.stock.view','receipt.view'])){
            $data = PoStock::findOrFail($id);
            $detail = $data->po_stock_detail()->with('stock_master')->get();
            $access =   $this->accessPoStock( $auth, 'po.stock');
            return DataTables::of($detail)
                ->addIndexColumn()
                ->addColumn('action', function($detail)  use($access, $data, $status){
                    $action = $this->buttonActionDetail($detail, $access, $data, $status);       
                    return $action;
                })
                ->rawColumns(['action'])->make(true);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Access Denied', 'stat' => 'Error']);
    }
}
