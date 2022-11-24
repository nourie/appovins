<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\OvinController;




use Illuminate\Http\Request;

class AvorterController extends Controller
{
    public function index()
    {
        $avorters =  DB::table('avorters')
            ->join('users', 'users.id', '=', 'avorters.id_user')
            ->join('ovins', 'ovins.id', '=', 'avorters.id_mere')
            ->distinct('avorters.id')
            ->orderByDesc('avorters.date_avorter')
            ->paginate(10, [
                'avorters.id', 'avorters.date_avorter', 'avorters.id_mere', 'avorters.nombre',
                'users.name', 'ovins.num'
            ]);
        return view('avorter.index', compact('avorters'));



        // return $naissance;
    }
}
