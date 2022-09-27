<?php

namespace App\Http\Controllers\Admins\Inventory;

use App\Models\StockMaster;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\ActionButton;
use App\Http\Controllers\Admins\SettingAjaxController;
use App\Http\Requests\Inventory\StockMasterStorePostRequest;
use App\Http\Requests\Inventory\StockMasterUpdatePatchRequest;

class StockMasterController extends SettingAjaxController
{
    use ActionButton;

    public function index()
    {
        if(Auth::user()->can('stock.master.view')){
            $data = [];
            return view('admins.contents.inventory.stock_master')->with($data);
        }
        return view('admins.components.403');
    }

    public function store(StockMasterStorePostRequest $request)
    {
        if(Auth::user()->can('stock.master.store')){
            $data = [
                'stock_no' => $request['stock_no'],
                'branch_id' => Auth::user()->branch_id,
                'bin' => $request['bin'],
                'name' => $request['name'],
                'satuan' => $request['satuan'],
                'min_soh' => $request['min_soh'],
                'max_soh' => $request['max_soh'],
            ];
            $activity = StockMaster::create($data);
            if ($activity->exists) {
                return response()
                    ->json(['code'=>200,'message' => 'Add new Stock Master Success', 'stat' => 'Success']);
            } else {
                return response()
                    ->json(['code'=>200,'message' => 'Error Stock Master Store', 'stat' => 'Error']);
            }
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Stock Master Access Denied', 'stat' => 'Error']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->can('stock.master.update')){
            $data = StockMaster::findOrFail($id);
            return $data;
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Stock Master Access Denied', 'stat' => 'Error']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StockMasterUpdatePatchRequest $request, $id)
    {
        if(Auth::user()->can('stock.master.update')){
            $data = StockMaster::find($id);
            $data->stock_no    = $request['stock_no'];
            $data->name    = $request['name'];
            $data->bin    = $request['bin'];
            $data->satuan    = $request['satuan'];
            $data->min_soh    = $request['min_soh'];
            $data->max_soh    = $request['max_soh'];
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'Edit Stock Master Success', 'stat' => 'Success']);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Stock Master Access Denied', 'stat' => 'Error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('stock.master.delete')){
            StockMaster::destroy($id);
            return response()
                ->json(['code'=>200,'message' => 'Stock Master Success Deleted', 'stat' => 'Success']);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Stock Master Access Denied', 'stat' => 'Error']);
    }

    public function record(){
        $auth =  Auth::user();
        if(Auth::user()->can('stock.master.view')){
            $data = StockMaster::latest()->get();
            $access =   $this->accessEditDelete( $auth, 'stock.master');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('soh', function($data){
                    $action = "";
                    return $action;
                })
                ->addColumn('action', function($data)  use($access){
                    $action = $this->buttonEditDelete($data, $access);
                    return $action;
                })
                ->rawColumns(['action'])->make(true);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Stock Master Access Denied', 'stat' => 'Error']);
    }

    /**
     * Search a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchStockMaster(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $tags = StockMaster::where([
            ['stock_no','like','%'.$term.'%'],
            ['branch_id','=', Auth::user()->branch_id]
        ])->get();

        $formatted_tags = [];

        foreach ($tags as $tag) {
            $formatted_tags[] = [
                'id'    => $tag->id,
                'text'  => $tag->stock_no,
                'name'  => $tag->name,
                'satuan'  => $tag->satuan,
                'harga_jual' => $tag->harga_jual,
                'harga_modal' => $tag->harga_modal,
            ];
        }

        return response()->json($formatted_tags);
    }
}
