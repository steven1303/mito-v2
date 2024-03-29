<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait ValidationPoStock {

    // Status Adjustment (String) [ Draft,Verify1, Verify2, Request, Approved ]

    function buttonAction($data, $access ){
        $action = "";
        $title = "'".$data->po_no."'";
        $spbd_detail = "javascript:ajaxLoad('".route('po.stock.form', ['id' => $data->id])."')";
        if($access['edit']){
            $action .= '<a href="'.$spbd_detail.'" class="btn btn-primary btn-xs"> Open</a> ';
        }
        if($access['verify1'] && $data->status == 'Request'){
            $action .= '<button id="'. $data->id .'" onclick="verify1('. $data->id .')" class="btn btn-success btn-xs"> Verify 1</button> ';
        }
        if($access['verify2'] && $data->status == 'Verified1'){
            $action .= '<button id="'. $data->id .'" onclick="verify2('. $data->id .')" class="btn btn-success btn-xs"> Verify 2</button> ';
        }
        if($access['approve'] && $data->status == 'Verified2'){
            $action .= '<button id="'. $data->id .'" onclick="approve('. $data->id .')" class="btn btn-success btn-xs"> Approve</button> ';
        }
        if($access['delete'] && $data->status == 'Draft'){
            $action .= '<button id="'. $data->id .'" onclick="deleteData('. $data->id .','.$title.')" class="btn btn-danger btn-xs"> Delete</button> ';
        }
        if($access['print'] && ($data->status == 'Request' || $data->status == 'Verified1' || $data->status == 'Verified2' || $data->status == 'Approved')){
            $action .= '<button id="'. $data->id .'" onclick="print_transfer_branch('. $data->id .')" class="btn btn-default btn-xs"> Print</button> ';
        }
        return $action;
    }

    function buttonActionDetail($detail, $access, $data, $status  = NULL){
        $action = "";
        $name = "'".$detail->stock_master->stock_no."'";
        if($access['edit'] && $data->status == "Draft"){
            $action .= '<button id="'. $detail->id .'" onclick="editForm('. $detail->id .')" class="btn btn-info btn-xs"> Edit</button> ';
        }
        if($access['delete'] && $data->status == "Draft"){
            $action .= '<button id="'. $detail->id .'" onclick="deleteData('. $detail->id .','.$name.')" class="btn btn-danger btn-xs"> Delete</button> ';
        }
        if($status == "RecStock" && $detail->rec_qty < $detail->qty){
            $action .= '<button id="'. $detail->id .'" onclick="addItem('. $detail->id .')" class="btn btn-info btn-xs">Add Item</button> ';
        }
        return $action;
    }

    function accessPoStock($auth, $permission){

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