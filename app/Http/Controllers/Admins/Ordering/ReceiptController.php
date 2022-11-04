<?php

namespace App\Http\Controllers\Admins\Ordering;

use App\Models\RecStock;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\DocNumber;
use App\Http\Controllers\Traits\StockMasterMovement;
use App\Http\Controllers\Admins\SettingAjaxController;
use App\Http\Controllers\Traits\ValidationReceiptStock;

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
            ];
            return view('admins.contents.ordering.receipt.receiptForm')->with($data);
        }
        return view('admins.components.403');
    }

    public function record(){
        $auth =  Auth::user();
        $access =   $this->accessReceiptStock( $auth, 'receipt');
        if($access['view']){
            $data = RecStock::latest()->get();
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
