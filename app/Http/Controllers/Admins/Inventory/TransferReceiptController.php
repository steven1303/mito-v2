<?php

namespace App\Http\Controllers\Admins\Inventory;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\TransferReceipt;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\DocNumber;
use App\Http\Controllers\Traits\StockMasterMovement;
use App\Http\Controllers\Admins\SettingAjaxController;

class TransferReceiptController extends SettingAjaxController
{
    use DocNumber;
    use StockMasterMovement;

    public function index()
    {
        if(Auth::user()->can('transfer.receipt.view')){
            $data = [];
            return view('admins.contents.inventory.transferReceipt.transferReceiptList')->with($data);
        }
        return view('admins.components.403');
    }

    public function transfer_branch_form($id)
    {
        if(Auth::user()->can('transfer.branch.store')){
            $transferReceipt = TransferReceipt::findOrFail($id);
            $branch = Branch::latest()->get();
            $data = [
                'transferBranch' => $transferReceipt,
                'branchs' => $branch
            ];
            return view('admins.contents.inventory.transferBranch.transferBranchForm')->with($data);
        }
        return view('admins.components.403');
    }

    public function record(){
        $auth =  Auth::user();
        if(Auth::user()->can('transfer.receipt.view')){
            $data = TransferReceipt::latest()->get();
            $access =   $this->accessTransferBranch( $auth, 'transfer.receipt');
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
            ->json(['code'=>200,'message' => 'Error Transfer Receipt Access Denied', 'stat' => 'Error']);
    }
}
