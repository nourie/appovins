<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Naissance;
use Illuminate\Http\Request;

class NaissanceController extends Controller
{
    public function index()
    {
        $naissances=  DB::table('naissances')
      ->join('users', 'users.id','=', 'naissances.id_user')
      ->join('ovins','ovins.id','=','naissances.id_mere')
       ->distinct('naissances.id')
       ->orderByDesc('naissances.date_naissance')
       ->paginate(10,['naissances.id','naissances.date_naissance','naissances.id_mere','naissances.nombre',
                'naissances.nombre_en_vie',
               'naissances.nombre_male','naissances.nombre_female','users.name','ovins.num'],'الصفحة');
    //    ->get();
       return view('naissance.index', compact('naissances'));



    // return $naissance;
    }
}
