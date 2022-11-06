<?php

namespace App\Http\Controllers\Admins\Ordering;

use App\Models\RecStock;
use Illuminate\Http\Request;
use App\Models\RecStockDetail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\DocNumber;
use App\Http\Controllers\Traits\StockMasterMovement;
use App\Http\Controllers\Admins\SettingAjaxController;
use App\Http\Controllers\Traits\ValidationReceiptStock;
use App\Http\Requests\Ordering\ReceiptDetailStorePostRequest;
use App\Http\Requests\Ordering\ReceiptDetailUpdatePatchRequest;

class ReceiptController extends SettingAjaxController
{
    use DocNumber; 
    use ValidationReceiptStock;    
    use StockMasterMovement;

    public function index()
    {
        if(Auth::user()->can('receipt.view')){
            $data = [];
            return view('admins.contents.ordering.receipt.receiptList')->with($data);
        }
        return view('admins.components.403');
    }

    public function rec_stock_form($id)
    {
        if(Auth::user()->can('receipt.store')){
            $rec = RecStock::findOrFail($id);
            $data = [
                'rec' => $rec,
                'po_stock_detail' => $rec->po_stock
            ];
            return view('admins.contents.ordering.receipt.receiptForm')->with($data);
        }
        return view('admins.components.403');
    }

    public function store(ReceiptDetailStorePostRequest $request)
    {
        if(!Auth::user()->can('receipt.store')){
            return response()->json(['code'=>200,'message' => 'Error Receipt Access Denied', 'stat' => 'Error']);
        }
        
        $draf = RecStock::where([
            ['status','=', 'Draft'],
        ])->count();

        if($draf > 0){
            return response()->json(['code'=>200,'message' => 'Use the previous Draf Receipt First', 'stat' => 'Warning']);
        }

        $document = RecStock::where([
            ['rec_no','like', $this->documentFormat('REC').'%'],
        ])->count();

        $data = [
            'branch_id' => Auth::user()->branch_id,
            'rec_no' => $this->documentFormat('REC').'/'.sprintf("%03d", $document + 1),
            'po_stock_id' => $request['po_stock'],
            'status' => 'Draft',
            'username' => Auth::user()->name,
        ];
        $activity = RecStock::create($data);
        if ($activity->exists) {
            return response()->json(['code'=>200,'message' => 'Add new Receipt Success' , 'stat' => 'Success', 'id' => $activity->id, 'process' => 'add']);

        } else {
            return response()->json(['code'=>200,'message' => 'Error Receipt Store', 'stat' => 'Error']);
        }
        
    }

    public function update(ReceiptDetailUpdatePatchRequest $request, $id)
    {
        if(Auth::user()->can('receipt.update')){
            $data = RecStock::find($id);
            $data->vendor_id    = $request['vendor'];
            $data->ppn    = ($request['ppn']) ? config('mito.tax.decimal') : 0;
            $data->rec_inv_ven    = $request['rec_inv_ven'];
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'Update PoStock Detail Success', 'stat' => 'Success']);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Transfer Branch Access Denied', 'stat' => 'Error']);
    }

    public function destroy($id)
    {
        if(Auth::user()->can('receipt.delete')){
            RecStock::destroy($id);
            return response()->json(['code'=>200,'message' => 'Receipt Success Deleted', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error Receipt Access Denied', 'stat' => 'Error']);
    }

    public function destroy_detail($id)
    {
        if(Auth::user()->can('receipt.update')){
            RecStockDetail::destroy($id);
            return response()->json(['code'=>200,'message' => 'Receipt Item Success Deleted', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error Receipt Access Denied', 'stat' => 'Error']);
    }

    public function record(){
        $auth =  Auth::user();
        $access =   $this->accessReceiptStock( $auth, 'receipt');
        if($access['view']){
            $data = RecStock::poStockDetail()->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data)  use($access){
                    $action = $this->buttonAction($data, $access);      
                    return $action;
                })
                ->rawColumns(['action'])->make(true);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Receipt Access Denied', 'stat' => 'Error']);
    }
}
