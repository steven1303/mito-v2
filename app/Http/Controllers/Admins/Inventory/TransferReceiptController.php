<?php

namespace App\Http\Controllers\Admins\Inventory;

use Carbon\Carbon;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\TransferReceipt;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\DocNumber;
use App\Http\Controllers\Traits\StockMasterMovement;
use App\Http\Controllers\Admins\SettingAjaxController;
use App\Http\Controllers\Traits\ValidationTransferReceipt;

class TransferReceiptController extends SettingAjaxController
{
    use DocNumber;
    use StockMasterMovement;
    use ValidationTransferReceipt;

    public function index()
    {
        if(Auth::user()->can('transfer.receipt.view')){
            $data = [];
            return view('admins.contents.inventory.transferReceipt.transferReceiptList')->with($data);
        }
        return view('admins.components.403');
    }

    public function transfer_receipt_form($id)
    {
        if(Auth::user()->can('transfer.receipt.store')){
            $transferReceipt = TransferReceipt::transferBranch()->findOrFail($id);
            $branches = Branch::latest()->get();
            $data = [
                'transferReceipt' => $transferReceipt,
                'branches' => $branches
            ];
            return view('admins.contents.inventory.transferReceipt.transferReceiptForm')->with($data);
        }
        return view('admins.components.403');
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('transfer.receipt.store')){
            $draf = TransferReceipt::where([
                ['status','=', 'Draft'],
                ['branch_id','=', Auth::user()->branch_id]
            ])->count();

            // dd($request->input());

            if($draf > 0){
                return response()
                    ->json(['code'=>200,'message' => 'Use the previous Draf Transfer Receipt First', 'stat' => 'Warning']);
            }

            $document = TransferReceipt::where([
                ['transfer_receipt_no','like', $this->documentFormat('TR').'%'],
                ['branch_id','=', Auth::user()->branch_id]
            ])->count();

            $data = [
                'branch_id' => Auth::user()->branch_id,
                'transfer_id' => $request['transfer_branch'],
                'transfer_receipt_no' => $this->documentFormat('TR').'/'.sprintf("%03d", $document + 1),
                'from_branch' => $request['branch'],
                'status' => 'Draft',
                'username' => Auth::user()->name,
            ];

            $activity = TransferReceipt::create($data);

            if ($activity->exists) {
                return response()
                    ->json(['code'=>200,'message' => 'Add new Transfer Receipt Success' , 'stat' => 'Success', 'id' => $activity->id, 'process' => 'add']);

            } else {
                return response()
                    ->json(['code'=>200,'message' => 'Error Transfer Receipt Store', 'stat' => 'Error']);
            }
        }
        return response()->json(['code'=>200,'message' => 'Error Transfer Receipt Access Denied', 'stat' => 'Error']);
    }

    public function record(Request $request){
        $auth =  Auth::user();
        if(Auth::user()->can('transfer.receipt.view')){
            $data = TransferReceipt::transferBranch()->latest()->get();
            $access =   $this->accessTransferReceipt( $auth, 'transfer.receipt');
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
