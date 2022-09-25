<?php

namespace App\Http\Controllers\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait DocNumber {

    function documentFormat($doc){

        $tanggal = Carbon::now();
        $format = $doc.'/'.Auth::user()->branch->name.'/'.$tanggal->format('y').'/'.$tanggal->format('m');
        return $format;
    }
}