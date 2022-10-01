<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait ValidationStockMaster {

    function buttonAction($data, $access ){
        $action = "";
        $title = "'".$data->name."'";
        $stock_movement = "javascript:ajaxLoad('".route('stock_master.movement', $data->id)."')";
        if($access['edit']){
            $action .= '<button id="'. $data->id .'" onclick="editForm('. $data->id .')" class="btn btn-info btn-xs"> Edit</button> ';
        }
        if($access['delete']){
            $action .= '<button id="'. $data->id .'" onclick="deleteData('. $data->id .','.$title.')" class="btn btn-danger btn-xs"> Delete</button> ';
        }
        
        if($access['movement'] ){
            $action .= '<a href="'.$stock_movement.'" class="btn btn-primary btn-xs"> History</a> ';
        }
        return $action;
    }

    function accessStockMaster($auth, $permission){

        $access = [
            'edit' => $auth->can($permission.'.update'),
            'delete' => $auth->can($permission.'.delete'),
            'movement' => $auth->can($permission.'.movement'),
        ];
        return $access;
    }
}