<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait ValidationTransferBranch {

    // Status Adjustment (String) [ Draft, Request, Approved ]

    function buttonAction($data, $access ){
        $action = "";
        $title = "'".$data->adj_no."'";
        $transfer_branch_detail = "javascript:ajaxLoad('".route('transfer.branch.form', ['id' => $data->id])."')";
        if($access['edit']){
            $action .= '<a href="'.$transfer_branch_detail.'" class="btn btn-primary btn-xs"> Open</a> ';
        }
        if($access['approve'] && $data->status == 'Request'){
            $action .= '<button id="'. $data->id .'" onclick="approve('. $data->id .')" class="btn btn-success btn-xs"> Approve</button> ';
        }
        if($access['delete'] && $data->status == 'Draft'){
            $action .= '<button id="'. $data->id .'" onclick="deleteData('. $data->id .','.$title.')" class="btn btn-danger btn-xs"> Delete</button> ';
        }
        if($access['print'] && ($data->status == 'Request' || $data->status == 'Approved')){
            $action .= '<button id="'. $data->id .'" onclick="print_adj('. $data->id .')" class="btn btn-default btn-xs"> Print</button> ';
        }
        return $action;
    }

    function buttonActionDetail($detail, $access, $data){
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

    function accessTransferBranch($auth, $permission){

        $access = [
            'view' => $auth->can($permission.'.view'),
            'edit' => $auth->can($permission.'.update'),
            'delete' => $auth->can($permission.'.delete'),
            'request' => $auth->can($permission.'.request'),
            'approve' => $auth->can($permission.'.approve'),
            'print' => $auth->can($permission.'.print'),
        ];
        return $access;
    }
}