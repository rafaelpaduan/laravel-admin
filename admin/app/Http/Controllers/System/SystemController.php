<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function loadAvg($index){

        $loadAvg = sys_getloadavg();

        return $loadAvg[$index];
    }

    public function loadAvg1m(){

        return number_format($this->loadAvg(0), 2);
    }

    public function loadAvg5m(){

        return number_format($this->loadAvg(1), 2);
    }

    public function loadAvg15m(){

        return number_format($this->loadAvg(2), 2);
    }

    public function systemTime(){
        
        return date('H:i:s');
    }

    public function memoryUsed(){
        
        return number_format((memory_get_usage($real_usage = true)/1024)/1024, 2);
    }
}
