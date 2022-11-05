<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait ValidationReceiptStock {

    // Status Adjustment (String) [ Draft,Verify1, Verify2, Request, Approved ]

    function buttonAction($data, $access ){
        $action = "";
        $title = "'".$data->rec_no."'";
        $spbd_detail = "javascript:ajaxLoad('".route('rec.stock.form', ['id' => $data->id])."')";
        if($access['edit']){
            $action .= '<a href="'.$spbd_detail.'" class="btn btn-primary btn-xs"> Open</a> ';
        }
        if($access['delete'] && $data->status == 'Draft'){
            $action .= '<button id="'. $data->id .'" onclick="deleteData('. $data->id .','.$title.')" class="btn btn-danger btn-xs"> Delete</button> ';
        }
        if($access['print'] && ($data->status == 'Request' || $data->status == 'Verified1' || $data->status == 'Verified2' || $data->status == 'Approved')){
            $action .= '<button id="'. $data->id .'" onclick="print_transfer_branch('. $data->id .')" class="btn btn-default btn-xs"> Print</button> ';
        }
        return $action;
    }

    function buttonActionDetail($detail, $access, $data, $status){
        $action = "";
        $name = "'".$detail->stock_master->stock_no."'";
        if($access['edit'] && $data->status == "Draft"){
            $action .= '<button id="'. $detail->id .'" onclick="editForm('. $detail->id .')" class="btn btn-info btn-xs"> Edit</button> ';
        }
        if($access['delete'] && $data->status == "Draft"){
            $action .= '<button id="'. $detail->id .'" onclick="deleteData('. $detail->id .','.$name.')" class="btn btn-danger btn-xs"> Delete</button> ';
        }
        return $action;
    }

    function accessReceiptStock($auth, $permission){

        $access = [
            'view' => $auth->can($permission.'.view'),
            'edit' => $auth->can($permission.'.update'),
            'delete' => $auth->can($permission.'.delete'),
            'request' => $auth->can($permission.'.request'),
            'verify1' => $auth->can($permission.'.verify1'),
            'verify2' => $auth->can($permission.'.verify2'),
            'approve' => $auth->can($permission.'.approve'),
            'print' => $auth->can($permission.'.print'),
        ];
        return $access;
    }
}