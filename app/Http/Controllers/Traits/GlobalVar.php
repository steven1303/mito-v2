<?php

namespace App\Http\Controllers\Admins\Traits;

trait GlobalVar {

    function documentFormat($doc){

        $tanggal = Carbon::now();
        $format = $doc.'/'.Auth::user()->branch->name.'/'.$tanggal->format('y').'/'.$tanggal->format('m');
        return $format;
    }
}