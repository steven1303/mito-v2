<?php

namespace App\Http\Controllers\Admins\Ordering;

use Carbon\Carbon;
use App\Models\Spbd;
use App\Models\SpbdDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\DocNumber;
use App\Http\Controllers\Traits\ValidationSpbd;
use App\Http\Requests\Ordering\SpbdStorePostRequest;
use App\Http\Controllers\Admins\SettingAjaxController;
use App\Http\Requests\Ordering\SpbdDetailStorePostRequest;
use App\Http\Requests\Ordering\SpbdDetailUpdatePatchRequest;

class SpbdController extends SettingAjaxController
{
    use DocNumber;    
    use ValidationSpbd;    

    public function index()
    {
        if(Auth::user()->can('spbd.view')){
            $data = [];
            return view('admins.contents.ordering.spbd.spbdList')->with($data);
        }
        return view('admins.components.403');
    }

    public function spbd_form($id)
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

    public function store(SpbdStorePostRequest $request)
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

    public function store_detail(SpbdDetailStorePostRequest $request, $id)
    {
        if(Auth::user()->can('spbd.store')){
            $data = [
                'branch_id' => Auth::user()->branch_id,
                'spbd_id' => $id,
                'stock_master_id' => $request['stock_master'],
                'qty' => $request['qty'],
                'keterangan' => $request['keterangan'],
            ];

            $activity = SpbdDetail::create($data);

            if ($activity->exists) {
                return response()
                    ->json(['code'=>200,'message' => 'Add new item Spbd Success', 'stat' => 'Success', 'process' => 'update']);

            } else {
                return response()
                    ->json(['code'=>200,'message' => 'Error item Spbd Store', 'stat' => 'Error']);
            }
        }
        return response()->json(['code'=>200,'message' => 'Error Spbd Access Denied', 'stat' => 'Error']);
    }

    public function edit_detail($id)
    {
        if(Auth::user()->can('spbd.update')){
            $data = SpbdDetail::with('stock_master')->findOrFail($id);
            return $data;
        }
        return response()->json(['code'=>200,'message' => 'Error SPBD Access Denied', 'stat' => 'Error']);
    }

    public function update_detail(SpbdDetailUpdatePatchRequest $request, $id)
    {
        if(Auth::user()->can('spbd.update')){
            $data = SpbdDetail::find($id);
            $data->stock_master_id    = $request['stock_master'];
            $data->qty    = $request['qty'];
            $data->keterangan    = $request['keterangan'];
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'Edit Item SPBD Success', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error SPBD Access Denied', 'stat' => 'Error']);
    }

    public function destroy($id)
    {
        if(Auth::user()->can('spbd.delete')){
            Spbd::destroy($id);
            return response()->json(['code'=>200,'message' => 'SPBD Item Success Deleted', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error SPBD Access Denied', 'stat' => 'Error']);
    }

    public function destroy_detail($id)
    {
        if(Auth::user()->can('spbd.delete')){
            SpbdDetail::destroy($id);
            return response()->json(['code'=>200,'message' => 'SPBD Item Success Deleted', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error SPBD Access Denied', 'stat' => 'Error']);
    }

    public function record(){
        $auth =  Auth::user();
        if($auth->can('spbd.view')){
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
            ->json(['code'=>200,'message' => 'Error SPBD Access Denied', 'stat' => 'Error']);
    }

    public function record_detail($id, $status = NULL){
        $auth =  Auth::user();
        if($auth->canany(['spbd.view','po.stock.view'])){
            $data = Spbd::findOrFail($id);
            $detail = $data->spbd_detail()->poStockDetail()->with('stock_master')->get();
            $access =   $this->accessSpbd( $auth, 'spbd');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function request($id)
    {
        if(Auth::user()->can('spbd.request')){
            $data = Spbd::findOrFail($id);
            if($data->spbd_detail->count() < 1)
            {
                return response()->json(['code'=>200,'message' => 'Error SPBD not have detail', 'stat' => 'Error']);
            }
            $data->status = "Request";
            $data->request = Carbon::now();
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'Request SPBD Success', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error SPBD Access Denied', 'stat' => 'Error']);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verify($id)
    {
        if(Auth::user()->can('spbd.verify')){
            $data = Spbd::findOrFail($id);
            $data->status = "Verified";
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'SPBD Verified Success', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error SPBD Access Denied', 'stat' => 'Error']);
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        if(Auth::user()->can('spbd.approve')){
            $data = Spbd::findOrFail($id);
            $data->status = "Approved";
            $data->approve = Carbon::now();
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'SPBD Approve Success', 'stat' => 'Success']);
        }
        return response()->json(['code'=>200,'message' => 'Error SPBD Access Denied', 'stat' => 'Error']);
    }

    /**
     * Search a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $tags = Spbd::where([
            ['spbd_no','like','%'.$term.'%'],
            ['status','=', "Partial"],
        ])->orWhere([
            ['spbd_no','like','%'.$term.'%'],
            ['status','=', "Approved"],
        ])->get();

        $formatted_tags = [];

        foreach ($tags as $tag) {
            $formatted_tags[] = [
                'id'    => $tag->id,
                'text'  => $tag->spbd_no,
            ];
        }

        return response()->json($formatted_tags);
    }
}
