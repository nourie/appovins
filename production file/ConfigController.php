<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function clear()
    {
    
        //$exitCode = \Artisan::call('optimize');
        //echo $exitCode;
        $exitCode = \Artisan::call('route:clear');
        echo $exitCode;
        $exitCode = \Artisan::call('config:cache');
        echo $exitCode;
        $exitCode = \Artisan::call('view:clear');
        echo $exitCode;


    }
}
