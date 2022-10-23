<?php

namespace App\Http\Controllers\Admins\Ordering;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\DocNumber;
use App\Http\Controllers\Traits\StockMasterMovement;
use App\Http\Controllers\Admins\SettingAjaxController;
use App\Http\Controllers\Traits\ValidationReceiptStock;
use App\Models\RecStock;

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
}
