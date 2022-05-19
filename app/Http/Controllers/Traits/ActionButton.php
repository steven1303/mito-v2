<?php

namespace App\Http\Controllers\Traits;


trait ActionButton {

    function buttonEditDelete($data, $access ){
        $action = "";
        $title = "'".$data->name."'";
        if($access['edit']){
            $action .= '<button id="'. $data->id .'" onclick="editForm('. $data->id .')" class="btn btn-info btn-xs"> Edit</button> ';
        }
        if($access['delete']){
            $action .= '<button id="'. $data->id .'" onclick="deleteData('. $data->id .','.$title.')" class="btn btn-danger btn-xs"> Delete</button> ';
        }
        return $action;
    }

    function accessEditDelete($auth, $permission){

        $access = [
            'edit' => $auth->can($permission.'.update'),
            'delete' => $auth->can($permission.'.delete')
        ];
        return $access;
    }
}