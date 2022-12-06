<?php

namespace App\Http\Controllers;

use App\Models\Ovin;
use App\Models\Naissance;
use App\Http\Controllers\NaissanceController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOvinRequest;
use App\Models\Achat;
use App\Models\Avorter;
use App\Models\Modification;
use Carbon;
use DateTime;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use SebastianBergmann\Timer\Duration;

class OvinController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Ovin::destroy($id);

        // return redirect()->route('ovins.index')->with('flash_message', 'Post deleted!');
        $ovins = Ovin::where('id', $id)->first();
        return view('ovins.mort', compact('ovins'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ovins = Ovin::where('taged', true)->where('alive', true)->where('vendu', false)->Paginate(10);
        return view('ovins.index', compact('ovins'));
    }

    public function dieindex()
    {
        $ovins = Ovin::where('alive', false)->where('taged',true)->orderBy('die_date', 'desc')->Paginate(10);

        return view('die.index', compact('ovins'));
    }
    public function dieindex2()
    {
        $ovins = Ovin::where('alive', false)->where('taged',false)->orderBy('die_date', 'desc')->Paginate(10);

        return view('die.index', compact('ovins'));
    }

    public function details($id)
    {
        $ovin = Ovin::where('id', $id)->first();
        $angnaux=Ovin::where('id_mere',$id)->orderBy('date_naissance','desc')->Paginate(5);
        $avorternaissances = $this->historique($id)->sortByDesc('date');
        if ($ovin->vendu==1)
        {
        $date_vente= DB::table('ovins')
        ->join('liste_ventes', 'liste_ventes.id_ovin', '=', 'ovins.id')
        ->join('ventes', 'ventes.id', '=', 'liste_ventes.id_vente')
        ->Where('id_ovin',$id)
        ->first()->date_vente;

        }
        else{
            $date_vente=null;
        }
        $sex='ذكر';
        if ($ovin->sexe==0)
        {
            $sex='أنثى';

        }
      

        if ($ovin->vendu == 1)
        {
          $status='بيع';
        }
        elseif($ovin->vendu == 2)
        {   
        $status='إعادة';
        }
        elseif($ovin->alive == 0)
        {
        $status='ميتة';
        }
        else{
        $status='حية';
        }
        if( is_null($ovin->date_naissance) )
        {
           $age="شراء";

        }
        elseif (is_null($ovin->die_date))
        {
          $age=$this->age($ovin->date_naissance,date('Y-m-d'))[4];  
        }
        else 
        {
            $age=$this->age($ovin->date_naissance,$ovin->die_date)[4];  
        }
        
        return view('ovins.details', compact('ovin','avorternaissances','angnaux','age','status','sex','date_vente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ovins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOvinRequest $request)
    {
        // $request->validate([
        //   'num'=> 'required|unique:ovins'
        // ]
        // );

        $ovin = new Ovin();
        $ovin->num = $request->num;
        $ovin->taged = true;
        $ovin->date_achat = $request->date_achat;
        $ovin->poid = $request->poid;
        $sex = true;
        if (strcmp($request->sexe, 'Female') === 0) {
            $sex = false;
        }
        $ovin->sexe = $sex;
        $ovin->alive = true;
        $ovin->vendu = false;
        $ovin->id_mere = 0;
        $ovin->id_source = 1; // 1 acheter
        $ovin->id_achat = 1;
        $ovin->save();
        // Ovin::create([
        //     num=>$request->num,
        //    date_achat=>$request->date_achat,

        // ])
        //  Ovin::create($request->all())  les nom request les meme que les nom des colone dans la table
        // return view('ovins.index');
        return redirect()->route('ovins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ovin  $ovin
     * @return \Illuminate\Http\Response
     */
    public function showbin()
    {

        $ovins = Ovin::onlyTrashed()->get();
        return view('ovins.bin', compact('ovins'));
    }

    public function show_agneau()
    {

        $ovins = Ovin::where('taged', false)->where('alive', true)->orderby('date_naissance', 'desc')->orderby('num', 'asc')->paginate(10);
        return view('ovins.index', compact('ovins'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ovin  $ovin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $ovin = Ovin::findorfail($id);
        $ovin = Ovin::where('id', $id)->first();
        return view('ovins.edit', compact('ovin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ovin  $ovin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $ovin = Ovin::findorFail($id);
        $old_num=$ovin->num;
        $ovin->num = $request->num;
        $ovin->date_achat = $request->date_achat;
        $ovin->poid = $request->poid;
        $sex = true;
        if (strcmp($request->sexe, 'Female') === 0) {
            $sex = false;
        }
        $ovin->sexe = $sex;
        $ovin->save();
        $modification= new Modification();
        $modification->cause=$request->cause;
        $modification->id_ovin=$id;
        $modification->old_num=$old_num;
        $modification->new_num=$request->num;
        $modification->date_mod=date('Y-m-d');
        $modification->save();



        return redirect()->route('ovins.index');
    }
    public function restore($id)
    {
        Ovin::withTrashed()
            ->where('id', $id)
            ->restore();
        return redirect()->back();
    }
    public function forcedelete($id)
    {
        Ovin::withTrashed()
            ->where('id', $id)
            ->forceDelete();
        return redirect()->back();
    }
    public function find(Request $request)
    {
        //     //$ovins= Ovin::all();
        return $request->num;

        // $ovins= Ovin::find($num);
        //
    }
    public function search(Request $request)

    {
        $ovins = Ovin::query()
            ->where('num', $request->q)
            ->paginate();
        $sender = 'update';
        // $ovins=Ovin::Recherche($request->q);
        return view('ovins.index', compact('ovins', 'sender'));
    }


    public function naissance(Request $request)
    {
        $ovin = Ovin::where('id', $request->id)->first();

        $avorternaissances = $this->historique($request->id)->sortByDesc('date');

        return view('ovins.naissance', compact('ovin', 'avorternaissances'));
    }
    public function historique($id)
    {
        $naissances =  DB::table('naissances')
            ->join('users', 'users.id', '=', 'naissances.id_user')
            ->join('ovins', 'ovins.id', '=', 'naissances.id_mere')
            ->where('ovins.id', $id)
            ->distinct('naissances.id')
            ->orderByDesc('naissances.date_naissance')
            ->get([
                'naissances.id as id', 'naissances.date_naissance as date', 'naissances.id_mere as idmere',
                'naissances.nombre_en_vie as nombre',
                'users.name as name', 'ovins.num as num', 'naissances.nombre as nas'
            ]);
        $avorters =  DB::table('avorters')
            ->join('users', 'users.id', '=', 'avorters.id_user')
            ->join('ovins', 'ovins.id', '=', 'avorters.id_mere')
            ->where('ovins.id', $id)
            ->distinct('avorters.id')
            // ->select()
            ->orderByDesc('avorters.date_avorter')
            ->get([
                'avorters.id as id', 'avorters.date_avorter as date', 'avorters.id_mere as idmere', 'avorters.nombre as nombre',
                'users.name as name', 'ovins.num as num', 'avorters.naissance as nas'
            ]);

        $avorternaissances = $naissances->merge($avorters);

        return $avorternaissances;
    }
    public function avorter(Request $request)
    {
        $ovin = Ovin::where('id', $request->id)->first();
        $avorternaissances = $this->historique($request->id)->sortByDesc('date');

        return view('ovins.avorter', compact('ovin', 'avorternaissances'));
    }
    public function addnaissance(Request $request, $id)
    {
        $ovin1 = Ovin::where('id', $request->id)->first();

        $ovin = Ovin::where('id_mere', $request->id)->latest('id')->first();
        //  return $ovin;

        if (is_null($ovin)) {
            $lastid = $ovin1->num * 10000;
        } else {
            $lastid = $ovin->num;
        }


        $naissance = new Naissance();
        $naissance->id_mere = $id;
        $naissance->date_naissance = $request->date_naissance;
        $naissance->nombre = $request->nombre;
        $naissance->nombre_en_vie = $request->nombre_en_vie;
        $naissance->nombre_male = $request->nombre_male;
        $naissance->nombre_female = $request->nombre_female;
        $naissance->id_user = $request->declareur;
        $naissance->save();

        $sexmale = $request->nombre_male;
        for ($i = 1; $i <= $request->nombre_en_vie; $i++) {

            $ovin = new Ovin();
            $ovin->num = $lastid + $i;
            $ovin->taged = false;
            $ovin->date_naissance = $request->date_naissance;
            $ovin->poid = $request->poid;
            if ($sexmale > 0) {
                $ovin->sexe = true;
            } else {
                $ovin->sexe = false;
            }
            $sexmale--;

            $ovin->alive = true;
            $ovin->vendu = false;
            $ovin->id_mere = $id;
            $ovin->id_source = 2; //naissance
            $ovin->id_achat = 1;
            $ovin->save();
        }

        return redirect('naissance/');
    }
    public function addavorter(Request $request, $id)
    {
        $avorter = new Avorter();
        $avorter->id_mere = $id;
        $avorter->date_avorter = $request->date_avorter;
        $avorter->nombre = $request->nombre;
        $avorter->id_user = $request->declareur;
        $avorter->naissance = false;
        $avorter->save();
        return redirect()->route('avorter.index');
    }

    public function die(Request $request)
    {
        // $mytime = Carbon\Carbon::now();
        // echo $mytime->toDateTimeString();
        $ovin = Ovin::where('id', $request->id)->first();
        return view('ovins.mort', compact('ovin'));
    }
    public function adddie(Request $request, $id)
    {

        $ovin = Ovin::findorFail($id);
        $ovin->alive = false;

        $ovin->die_status = $request->die_status;
        $ovin->die_cause = $request->die_cause;
        $ovin->die_date = $request->die_date;
        $ovin->save();
        return redirect()->route('ovins.index');
    }
    public static function getNiceDuration($durationInSeconds)
    {
    }
    public static function age($naissance, $now)
    {

        // $now = date('Y-m-d');

        // dd( Duration ($naissance-$now));
        $ageday = (strtotime($now) - strtotime($naissance)) / 86400; //(60 * 60 * 24))= age on jours;

        $durationInSeconds = $ageday * 86400;

        $duration = '';
        $years = floor($durationInSeconds / 31536000);
        $durationInSeconds -= $years * 31536000;
        $months = floor($durationInSeconds / 2628000);
        $durationInSeconds -= $months * 2628000;
        $days = floor($durationInSeconds / 86400);

        $age[0] = $years;
        $age[1] = $months;
        $age[2] = $days;

        if ($years > 0) {
            $duration .= $years . ' سنة';
        }
        if ($months > 0) {
            $duration .= ' ' . $months . ' شهر';
        }
        if ($days > 0) {
            $duration .= ' ' . $days . ' يوم';
        }
        $age[4] = $duration;
        return $age;
    }
}
