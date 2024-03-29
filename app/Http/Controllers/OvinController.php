<?php

namespace App\Http\Controllers;

use App\Models\Ovin;
use App\Models\Lot;
use App\Models\Ovin_Lot;

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
use Illuminate\Database\Eloquent\SoftDeletes;

use function PHPUnit\Framework\isNull;

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
        $ovins = Ovin::where('taged', true)->where('alive', true)->where('vendu', '0')->Paginate(10);
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
       
        $numere = Ovin::where('id',$ovin->id_mere)->first();
        if (is_null($numere))
        {
           // dd($numere);
           $numere='شراء';
        }
        else 
        {
         $numere =$numere->num;
        }
   
        //$angnaux=Ovin::where('id_mere',$id)->orderBy('date_naissance','desc')->Paginate(5);
       $angnaux=Ovin::join ('ovin__lots','id_ovin','ovins.id')
       ->join('lots','lots.id','ovin__lots.id_lot')
       ->join('color_lots','color_lots.id','lots.color_id')
       ->where('id_mere',$id)
       ->orderBy('date_naissance','desc')
       ->Paginate(5);
      
     
     $anlot=Ovin::join ('ovin__lots','id_ovin','ovins.id')
     ->join('lots','lots.id','ovin__lots.id_lot')
     ->join('color_lots','color_lots.id','lots.color_id')
     ->where('id_ovin',$id)
     ->orderBy('date_naissance','desc')
     ->get();
     if ($anlot->count()==0)
     {
    
        $num_in_lot="لا يوجد";
        $nomlot="لا يوجد";
     }
     else 
     {
        $num_in_lot=$anlot[0]->num_in_lot;
        $nomlot=$anlot[0]->nom;

     }
       
      // dd($angnaux);        
        $avorternaissances = $this->historique($id)->sortByDesc('date');
        $date_vente=null;
        $sex='ذكر';
        if ($ovin->sexe==0)
        {
            $sex='أنثى';

        }
      

        if ($ovin->vendu != 0)
        {
          $status='بيع';
          $date_vente= DB::table('ovins')
          ->join('liste_ventes', 'liste_ventes.id_ovin', '=', 'ovins.id')
          ->join('ventes', 'ventes.id', '=', 'liste_ventes.id_vente')
          ->Where('id_ovin',$id)
          ->first()->date_vente;
        }
        elseif($ovin->vendu == 2)
        {   
        $status='إعادة';

        $date_vente= DB::table('ovins')
        ->join('avoir_achats', 'avoir_achats.id_ovin', '=', 'ovins.id')
        ->join('achats', 'achats.id', '=', 'avoir_achats.id_achat')
        ->Where('id_ovin',$id)
        ->first()->date_achat;
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
        
        return view('ovins.details', compact('ovin','avorternaissances','angnaux','age','status','sex','date_vente','numere','num_in_lot','nomlot'));
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
    public function store(Request $request)
    {
        $request->validate([
          'num'=> 'required|unique:ovins'
        ]
        );

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
        $ovin->date_inventaire = $request->date_achat; 
        $ovin->inventaire = 1;
        $ovin->id_source = $request->source; // 1 acheter  2 naissance 3 novelle numérotaion
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

        $ovins = Ovin::where('taged', false)->where('alive', true)->where('vendu','0')->orderby('date_naissance', 'desc')->orderby('num', 'asc')->paginate(10);
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
        $unique = Ovin::where('num', $request->num)->get();// a faire une focntion pour vérifier les numéros pour etres unique
        $valide=false;
       
        if ($unique->count()>1)
        {
            
        $request->validate([
            'num'=> 'required|unique:ovins'
          ]
          );
            
        }
        elseif (($unique->count()== 1) && ($unique[0]->id==$id)  )
        {
            $valide=true;  
           
        }
        elseif ( ($unique->count()== 1) && ($unique[0]->id!=$id)) {
           $valide=false;
         
        }
        elseif (($unique->count()== 0))
         {
            $valide=true;
        }
        else 
        { 
            $valide=false;
        }
        if ($valide==true)
        {

            $ovin = Ovin::findorFail($id);
            $old_num=$ovin->num;
            $ovin->num = $request->num;
            $ovin->date_achat = $request->date_achat;
            $ovin->poid = $request->poid;
            $sex = true;
            if ($request->taged==1)
            {
                $ovin->taged = true;
            }
            
    
            if (strcmp($request->sexe, 'Female') === 0) {
                $sex = false;
            }
            $ovin->sexe = $sex;
            $ovin->date_inventaire = $request->date_inventaire;
            $ovin->inventaire = $request->inventaire;

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
        else {
            return 'الرقم موجود';
        }


       
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
        $ovin1->date_inventaire =$request->date_naissance;
        $ovin1->inventaire=1;
        $ovin1->save();
       //   dd($ovin1);
        $ovin = Ovin::where('id_mere', $request->id)->get();
        $lastid=$ovin1->num *10000+$ovin->count();
        $nlot=0;
        // return $lastid;

        // if (is_null($ovin)) {
        //     $lastid = $ovin1->num * 10000;
        // } else {
        //     $lastid = $ovin->num;
        // }
        $lot = Lot::where('active', true)->first();

        if (is_null($lot))
        {
            $error=' لا توجد مجموعة مفعلة ' ;
            return redirect()->route('lot.index', $error);

        }
            
             
        else
        {  
              
            if ( $request->nombre_en_vie ==0)
            {
                $unique =0;   
            }
            else  
           {
            $unique_num_in_lot=Ovin_lot::where('id_lot','=',$lot->id)
            ->where('num_in_lot','=',$request->num_in_lot)->get();
            $unique=$unique_num_in_lot->count();
            }

     if ( ($unique==0)) {

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

          
                    $ovin_lots =new Ovin_lot();
                    $id_ovin=Ovin::where('id_mere', $request->id)->latest('id')->first();
                    $ovin_lots->id_ovin=$id_ovin->id;
                    $ovin_lots->num_in_lot=$request->num_in_lot+$nlot;
                    $ovin_lots->id_lot=$lot->id;
                    $ovin_lots->save();
                    $nlot++;// pour faire des numéro def en serie 1 2 3 4 meme pour les gémeaux


                }
            }
            else 
                { 
                   // dd( $unique_num_in_lot);
                    return ('الرقم موجود في المجموعة');
                }
            
           
        
        }
        $nbr=Ovin_lot::where('id_lot','=',$lot->id)->count();
        $lot->nbr_ovins = $nbr;
        $init=Ovin_Lot::where('id_lot','=',$lot->id)->withTrashed()->count();
        $lot->nbr_init=$init;
        $lot->save();

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
        $ovins = Ovin::where('id', $id)->first();
        $ovins->date_inventaire = $request->date_achat; 
        $ovins->inventaire=1;
        $ovins->save();
        return redirect()->route('avorter.index');
    }

    public function die(Request $request)
    {
        // $mytime = Carbon\Carbon::now();
        // echo $mytime->toDateTimeString();
        $ovins = Ovin::where('id', $request->id)->first();
        return view('ovins.mort', compact('ovins'));
    }
    public function adddie(Request $request, $id)
    {

        $ovin = Ovin::findorFail($id);
        $ovin->alive = false;

        $ovin->die_status = $request->die_status;
        $ovin->die_cause = $request->die_cause;
        $ovin->die_date = $request->die_date;
        $ovin->save();
        $Ovin_lot = Ovin_lot::where('id_ovin', '=', $id)->get();
        if ($Ovin_lot->count()>0)
        {
            $Ovin_lot = Ovin_lot::where('id_ovin', '=', $id)->first();

            $lot = Lot::where('id', $Ovin_lot->id_lot)->first();
            
            
            $Ovin_lot->delete();
            $nbr=Ovin_lot::where('id_lot','=',$lot->id)->count();
            $lot->nbr_ovins = $nbr;
            $lot->save();
            
        }
     
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
