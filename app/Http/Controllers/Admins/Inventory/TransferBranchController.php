<?php

namespace App\Http\Controllers\Admins\Inventory;

use Carbon\Carbon;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\TransferBranch;
use Yajra\DataTables\DataTables;
use App\Models\TransferBranchDetail;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\DocNumber;
use App\Http\Controllers\Traits\StockMasterMovement;
use App\Http\Controllers\Admins\SettingAjaxController;
use App\Http\Controllers\Traits\ValidationTransferBranch;
use App\Http\Requests\Inventory\TransferBranchDetailStorePostRequest;
use App\Http\Requests\Inventory\TransferBranchDetailUpdatePatchRequest;

class TransferBranchController extends SettingAjaxController
{
    use DocNumber;
    use StockMasterMovement;
    use ValidationTransferBranch;
    
    public function index()
    {
        if(Auth::user()->can('transfer.branch.view')){
            $data = [];
            return view('admins.contents.inventory.transferBranch.transferBranchList')->with($data);
        }
        return view('admins.components.403');
    }

    public function transfer_branch_form($id)
    {
        if(Auth::user()->can('transfer.branch.store')){
            $transferBranch = TransferBranch::findOrFail($id);
            $branch = Branch::latest()->get();
            $data = [
                'transferBranch' => $transferBranch,
                'branchs' => $branch
            ];
            return view('admins.contents.inventory.transferBranch.transferBranchForm')->with($data);
        }
        return view('admins.components.403');
    }

    public function store(Request $request)
    {
        if(Auth::user()->can('transfer.branch.store')){
            $draf = TransferBranch::where([
                ['status','=', 'Draft'],
                ['branch_id','=', Auth::user()->branch_id]
            ])->count();

            if($draf > 0){
                return response()->json(['code'=>200,'message' => 'Use the previous Draf Transfer First', 'stat' => 'Warning']);
            }

            $document = TransferBranch::where([
                ['transfer_no','like', $this->documentFormat('TB').'%'],
                ['branch_id','=', Auth::user()->branch_id]
            ])->count();

            $data = [
                'branch_id' => Auth::user()->branch_id,
                'transfer_no' => $this->documentFormat('TB').'/'.sprintf("%03d", $document + 1),
                'status' => 'Draft',
                'username' => Auth::user()->name,
            ];
            $activity = TransferBranch::create($data);
            if ($activity->exists) {
                return response()->json(['code'=>200,'message' => 'Add new Transfer Success' , 'stat' => 'Success', 'id' => $activity->id, 'process' => 'add']);

            } else {
                return response()->json(['code'=>200,'message' => 'Error Transfer Store', 'stat' => 'Error']);
            }
        }
        return response()->json(['code'=>200,'message' => 'Error Transfer Access Denied', 'stat' => 'Error']);
    }

    public function store_detail(TransferBranchDetailStorePostRequest $request, $id)
    {
        if(Auth::user()->can('transfer.branch.store')){
            $data = [
                'branch_id' => Auth::user()->branch_id,
                'transfer_branch_id' => $id,
                'stock_master_id' => $request['stock_master'],
                'qty' => $request['qty'],
                'keterangan' => $request['keterangan'],
            ];

            $activity = TransferBranchDetail::create($data);

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

    public function update(Request $request, $id)
    {
        if(Auth::user()->can('transfer.branch.update')){
            $data = TransferBranch::find($id);
            $data->to_branch    = $request['branch'];
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'Update Transfer Detail Success', 'stat' => 'Success']);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Transfer Branch Access Denied', 'stat' => 'Error']);
    }

    public function edit_detail($id)
    {
        if(Auth::user()->can('transfer.branch.update')){
            $data = TransferBranchDetail::with('stock_master')->findOrFail($id);
            return $data;
        }
        return response()->json(['code'=>200,'message' => 'Error Transfer Branch Access Denied', 'stat' => 'Error']);
    }

    public function update_detail(TransferBranchDetailUpdatePatchRequest $request, $id)
    {
        if(Auth::user()->can('transfer.branch.update')){
            $data = TransferBranchDetail::find($id);
            $data->stock_master_id    = $request['stock_master'];
            $data->qty    = $request['qty'];
            $data->keterangan    = $request['keterangan'];
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'Edit Item Transfer Success', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error Transfer Access Denied', 'stat' => 'Error']);
    }

    public function destroy($id)
    {
        if(Auth::user()->can('transfer.branch.delete')){
            TransferBranch::destroy($id);
            return response()->json(['code'=>200,'message' => 'Transfer Branch Success Deleted', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error Transfer Access Denied', 'stat' => 'Error']);
    }

    public function destroy_detail($id)
    {
        if(Auth::user()->can('transfer.branch.delete')){
            TransferBranchDetail::destroy($id);
            return response()->json(['code'=>200,'message' => 'Transfer Item Success Deleted', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error Transfer Access Denied', 'stat' => 'Error']);
    }

    public function record(){
        $auth =  Auth::user();
        if(Auth::user()->can('transfer.branch.view')){
            $data = TransferBranch::latest()->get();
            $access =   $this->accessTransferBranch( $auth, 'transfer.branch');
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

    public function record_detail($id){
        $auth =  Auth::user();
        if(Auth::user()->can('transfer.branch.view')){
            $data = TransferBranch::findOrFail($id);
            $detail = $data->transfer_branch_detail()->with('stock_master')->get();
            $access =   $this->accessTransferBranch( $auth, 'transfer.branch');
            return DataTables::of($detail)
                ->addIndexColumn()
                ->addColumn('action', function($detail)  use($access, $data){
                    $action = $this->buttonActionDetail($detail, $access, $data);       
                    return $action;
                })
                ->rawColumns(['action'])->make(true);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Adjustment Access Denied', 'stat' => 'Error']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function request($id)
    {
        if(Auth::user()->can('transfer.branch.request')){
            $data = TransferBranch::findOrFail($id);
            if($data->transfer_branch_detail->count() < 1)
            {
                return response()->json(['code'=>200,'message' => 'Error Transfer Branch not have detail', 'stat' => 'Error']);
            }
            if($data->to_branch == 0)
            {
                return response()->json(['code'=>200,'message' => 'Error Transfer To Branch Not Set', 'stat' => 'Error']);
            }
            $data->status = "Request";
            $data->transfer_request = Carbon::now();
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'Open Transfer Branch Success', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error Transfer Branch Access Denied', 'stat' => 'Error']);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        if(Auth::user()->can('transfer.branch.approve')){
            $data = TransferBranch::findOrFail($id);
            $data->status = "Approved";
            $data->transfer_date = Carbon::now();
            $data->update();
            $this->addMovement($data->transfer_branch_detail()->get(), $data->transfer_no, "TB","Transfer Branch Approved at", Carbon::createFromFormat('d/m/Y H:m A', $data->transfer_date)->format('Y-m-d H:i:s'));
            return response()
                ->json(['code'=>200,'message' => 'Transfer Branch Approve Success', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error Transfer Branch Access Denied', 'stat' => 'Error']);
    }

     /**
     * Search a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchTransferBranch(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $tags = TransferBranch::withoutGlobalScopes()->where([
            ['transfer_no','like','%'.$term.'%'],
            ['to_branch','=', Auth::user()->branch_id],
            ['status','=', 'Approved'],
        ])->get();

        $formatted_tags = [];

        foreach ($tags as $tag) {
            $formatted_tags[] = [
                'id'    => $tag->id,
                'text'  => $tag->transfer_no,
                'branch_id'  => $tag->branch_id,
                'branch_name'  => $tag->branch->city,
            ];
        }

        return response()->json($formatted_tags);
    }
    
}
