<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait ValidationSpbd {

    // Status Adjustment (String) [ Draft, Request, Verify, Approved ]

    function buttonAction($data, $access ){
        $action = "";
        $title = "'".$data->spbd_no."'";
        $spbd_detail = "javascript:ajaxLoad('".route('spbd.form', ['id' => $data->id])."')";
        if($access['edit']){
            $action .= '<a href="'.$spbd_detail.'" class="btn btn-primary btn-xs"> Open</a> ';
        }
        if($access['verify'] && $data->status == 'Request'){
            $action .= '<button id="'. $data->id .'" onclick="verify('. $data->id .')" class="btn btn-success btn-xs"> Verify</button> ';
        }
        if($access['approve'] && $data->status == 'Verified'){
            $action .= '<button id="'. $data->id .'" onclick="approve('. $data->id .')" class="btn btn-success btn-xs"> Approve</button> ';
        }
        if($access['delete'] && $data->status == 'Draft'){
            $action .= '<button id="'. $data->id .'" onclick="deleteData('. $data->id .','.$title.')" class="btn btn-danger btn-xs"> Delete</button> ';
        }
        if($access['print'] && ($data->status == 'Request' || $data->status == 'Verified' || $data->status == 'Partial' || $data->status == 'Approved')){
            $action .= '<button id="'. $data->id .'" onclick="print_transfer_branch('. $data->id .')" class="btn btn-default btn-xs"> Print</button> ';
        }
        return $action;
    }

    function buttonActionDetail($detail, $access, $data, $status = NULL){
        $action = "";
        $name = "'".$detail->stock_master->stock_no."'";
        if($access['edit'] && $data->status == "Draft"){
            $action .= '<button id="'. $detail->id .'" onclick="editForm('. $detail->id .')" class="btn btn-info btn-xs"> Edit</button> ';
        }
        if($access['delete'] && $data->status == "Draft"){
            $action .= '<button id="'. $detail->id .'" onclick="deleteData('. $detail->id .','.$name.')" class="btn btn-danger btn-xs"> Delete</button> ';
        }
        if($status == "PoStock" && $detail->po_qty < $detail->qty){
            $action .= '<button id="'. $detail->id .'" onclick="addItem('. $detail->id .')" class="btn btn-info btn-xs">Add Item</button> ';
        }
        return $action;
    }

    function accessSpbd($auth, $permission){

        $access = [
            'view' => $auth->can($permission.'.view'),
            'edit' => $auth->can($permission.'.update'),
            'delete' => $auth->can($permission.'.delete'),
            'request' => $auth->can($permission.'.request'),
            'verify' => $auth->can($permission.'.verify'),
            'approve' => $auth->can($permission.'.approve'),
            'print' => $auth->can($permission.'.print'),
        ];
        return $access;
    }
}