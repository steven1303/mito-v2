<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait ValidationAdjustment {

    function buttonAction($data, $access ){
        $action = "";
        $title = "'".$data->name."'";
        $adj_detail = "javascript:ajaxLoad('".route('adj.form', ['id' => $data->id])."')";
        if($access['edit']){
            $action .= '<a href="'.$adj_detail.'" class="btn btn-info btn-xs"> Edit</a> ';
        }
        if($access['approve'] && $data->status == 'Request'){
            $action .= '<button id="'. $data->id .'" onclick="approve('. $data->id .')" class="btn btn-info btn-xs"> Approve</button> ';
        }
        if($access['delete'] && $data->status == 'Draft'){
            $action .= '<button id="'. $data->id .'" onclick="deleteData('. $data->id .','.$title.')" class="btn btn-danger btn-xs"> Delete</button> ';
        }
        if($access['print'] && ($data->status == 'Request' || $data->status == 'Approved')){
            $action .= '<button id="'. $data->id .'" onclick="print_adj('. $data->id .')" class="btn btn-normal btn-xs"> Print</button> ';
        }
        return $action;
    }

    function accessAdjustment($auth, $permission){

        $access = [
            'edit' => $auth->can($permission.'.view'),
            'delete' => $auth->can($permission.'.delete'),
            'approve' => $auth->can($permission.'.approve'),
            'print' => $auth->can($permission.'.print'),
        ];
        return $access;
    }
}