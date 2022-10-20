<?php

namespace App\Http\Controllers\Admins\Settings;

use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Traits\ActionButton;
use App\Http\Controllers\Admins\SettingAjaxController;
use App\Http\Requests\Settings\CustomerStorePostRequest;
use App\Http\Requests\Settings\CustomerUpdatePatchRequest;

class CustomerController extends SettingAjaxController
{
    use ActionButton;

    public function index()
    {
        if(Auth::user()->can('customer.view')){
            $data = [
            ];
            return view('admins.contents.settings.customer')->with($data);
        }
        return view('admins.components.403');
    }

    public function info($id)
    {
        if(Auth::user()->can('customer.info')){
            $customer = Customer::findOrFail($id);
            $data = [
                'customer' => $customer
            ];
            return view('admins.content.customer_info')->with($data);
        }
        return view('admins.components.403');
    }

    public function store(CustomerStorePostRequest $request)
    {
        if(Auth::user()->can('customer.store')){
            $data = [
                'branch_id' => Auth::user()->branch_id,
                'name' => $request['name'],
                'address1' => $request['address1'],
                'address2' => $request['address2'],
                'email' => $request['email'],
                'city' => $request['city'],
                'pic' => $request['pic'],
                'telp' => $request['telp'],
                'phone' => $request['phone'],
                'npwp' => $request['npwp'],
                'tax' => config('mito.tax.decimal'),
                'ktp' => $request['ktp'],
                'bod' => $request['bod'],
            ];
            $activity = Customer::create($data);
            if ($activity->exists) {
                return response()
                    ->json(['code'=>200,'message' => 'Add new Customer Success', 'stat' => 'Success']);

            } else {
                return response()
                    ->json(['code'=>200,'message' => 'Error Customer Store', 'stat' => 'Error']);
            }
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Customer Access Denied', 'stat' => 'Error']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdatePatchRequest $request, $id)
    {
        if(Auth::user()->can('customer.update')){
            $data = Customer::find($id);
            $data->name    = $request['name'];
            $data->address1    = $request['address1'];
            $data->address2   = $request['address2'];
            $data->email = $request['email'];
            $data->city = $request['city'];
            $data->pic = $request['pic'];
            $data->telp = $request['telp'];
            $data->phone    = $request['phone'];
            $data->npwp    = $request['npwp'];
            $data->tax = config('mito.tax.decimal');
            $data->ktp    = $request['ktp'];
            $data->bod    = $request['bod'];
            $data->update();
            return response()
                ->json(['code'=>200,'message' => 'Edit Customer Success', 'stat' => 'Success']);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Customer Access Denied', 'stat' => 'Error']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->can('customer.update')){
            $data = Customer::findOrFail($id);
            return $data;
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Customer Access Denied', 'stat' => 'Error']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('customer.delete')){
            Customer::destroy($id);
            return response()
                ->json(['code'=>200,'message' => 'Customer Success Deleted', 'stat' => 'Success']);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Customer Access Denied', 'stat' => 'Error']);
    }

    public function record(){
        $auth =  Auth::user();
        if($auth->can('customer.view')){
            $data = Customer::all();
            $access =  $this->accessEditDelete( $auth, 'customer');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data) use($access){
                    $action = $this->buttonEditDelete($data, $access);
                    // $invoice_detail = "javascript:ajaxLoad('".route('local.customer.info', $data->id)."')";
                    // if($access->can('customer.info')){
                    //     $action .= '<a href="'.$invoice_detail.'" class="btn btn-warning btn-xs"> Info</a> ';
                    // }
                    return $action;
                })
                ->rawColumns(['action'])
                ->only(['name','city','npwp','phone','action'])->make(true);
        }
        return response()
            ->json(['code'=>200,'message' => 'Error Customer Access Denied', 'stat' => 'Error']);
    }
}
