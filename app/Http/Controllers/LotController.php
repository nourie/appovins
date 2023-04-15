<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Lot;
use App\Models\ColorLot;
use App\Models\Ovin_Lot;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class LotController extends Controller
{ 
    public function ajouter()
    {
        $colors=ColorLot::get();
        return view( 'lot.ajouter',compact('colors'));
    }
    public function insert(Request $request)
    {
        
        
        $active =Lot::where('active','=',1)->count();
       
        
        if ($active>0)
          { 
             $error='يجب إنهاء المجموعة السابقة قبل فتح مجموعة جدبدة';
             return  redirect()->route('lot.index',$error);
             
             
             
           
        }
        else 
        { 
            $maxdate=Lot::all('fin_lot')->max('fin_lot') ;
            $validated = $request->validate([
             'debut_lot' => 'required|unique:lots|date'
                ]);
               if ($request->debut_lot <= $maxdate  )
               {
               
                 // if($validator->fails()) {
                     // return Redirect::back()->withErrors($validator);
     
                     // 'start_date' => 'required|date|after:tomorrow'
                     // 'finish_date' => 'required|date|after:start_date'
                     $error = 'التاريخ الخاطىء يجب أن يكون بعد نهاية المجموعة السابقة';
                     return redirect()->route('lot.index', $error);
     
     
     
                 
               } else {
                $lot = new Lot();
                $lot->color_id = $request->couleur;
                $lot->active = 1;
                $lot->debut_lot = $request->debut_lot;
            
                $lot->save();
                $error =1;
                return redirect()->route('lot.index', $error);
            }

        }
       

              }


    public function old ()
    {
      $debut=date('2022-01-01');
      $fin=date('2022-10-31');
      $ovins=  DB::table('ovins')
      ->whereBetween ('ovins.date_naissance',[$debut,$fin] )
      ->get(['ovins.id','ovins.num','die_date']);
      echo "le nombre :";
      echo $ovins->count();
     
    
    
     echo "\r\n";
     $nbr=0;
     foreach ($ovins as $ovin)
     {
     $nbr++;
     $ovin_lots =new Ovin_lot();
     $ovin_lots->id_ovin=$ovin->id;
     $ovin_lots->num_in_lot=0;
     $ovin_lots->id_lot=1;
     $ovin_lots->deleted_at=$ovin->die_date;
     $ovin_lots->save();
     echo $ovin->num;
     echo "\r\n";

     }
     echo $nbr;
     $lot = Lot::where('id','1')->first();
     $nbr=Ovin_lot::where('id_lot','=',$lot->id)->count();
     $lot->nbr_ovins = $nbr;
     $lot->save();

     return $ovins;
    }          
    public function index($err)
    { 

        
        $lots=DB::table ('color_lots') 
        ->join ('lots','lots.color_id','=','color_lots.id')
        // ->union ('SELECT COUNT(*) FROM ovin__lots WHERE ovin__lots.id_lot =lots.id ) as nbre'
        // ->union('ovin__lots','id_lot','=','lots.id')
        ->orderBy('lots.id')
         ->get();
         
       //dd($lots);

    //    $lots = Lot::join('color_lots','color_lots.id','=','lots.color_id') try to get sheep sum in lot 
    //    ->get();
    // // ->select(
    // //    'Lots.*', '4444' as nnnn);
       
       
       
    //    DB::raw('(SELECT COUNT(*) FROM ovin__lots WHERE ovin__lots.id_lot = lots.id) as nbre')
    // ])->groupBy('lots.id');
        
        
        
       // ('active',true)->first()->get();


        //////////////////////
        // $date_vente= DB::table('ovins')
        // ->join('liste_ventes', 'liste_ventes.id_ovin', '=', 'ovins.id')
        // ->join('ventes', 'ventes.id', '=', 'liste_ventes.id_vente')
        // ->Where('id_ovin',$id)
        // ->first()->date_vente;
        // ////////////////////
        return view('lot.index',compact('lots','err'));

    }

    public function close($id)
    {
       // $lot = Lot::findorfail($id);
       $lot=DB::table ('color_lots') 
       ->join ('lots','lots.color_id','=','color_lots.id')
       // ->union ('SELECT COUNT(*) FROM ovin__lots WHERE ovin__lots.id_lot =lots.id ) as nbre'
       // ->union('ovin__lots','id_lot','=','lots.id')
       ->where ('lots.id','=',$id)
        ->first();
      
       $nbr=Ovin_Lot::where('id_lot','=',$id)->count();
       return view('lot.closed', compact('lot','nbr'));
    }
     public function inlot($id)
     {
    
    $ovins=  DB::table('ovin__lots')
    ->join('ovins',  'ovins.id' ,'=','ovin__lots.id_ovin')
     ->join('ovins as mere','mere.id','=','ovins.id_mere')
      ->where('ovins.alive',true)
    ->where( 'ovin__lots.id_lot',$id)
     ->orderBy('ovin__lots.num_in_lot')
     ->paginate(20,['mere.num as mere','mere.id as id_mere', 'ovins.num','ovins.id as id','ovins.sexe','ovins.date_naissance','ovins.die_date','ovins.date_achat','num_in_lot','ovins.alive','ovins.vendu']);
     //->get(['mere.num as mere', 'ovins.num','ovins.id as id','ovins.sexe','ovins.date_naissance','ovins.die_date','ovins.date_achat','num_in_lot','ovins.alive','ovins.vendu']);
     //return $ovins;
     return view('lot.inlot', compact('ovins'));
     }
    public function closelot(Request $request)
    {



       $maxdate=Lot::all('debut_lot')->max('debut_lot') ;
       $validated = $request->validate([
        'fin_lot' => 'required|unique:lots|date|after:debut_lot'
           ]);
          if ($request->fin_lot <= $maxdate  )
          {
          
            // if($validator->fails()) {
                // return Redirect::back()->withErrors($validator);

                // 'start_date' => 'required|date|after:tomorrow'
                // 'finish_date' => 'required|date|after:start_date'
            return "dddd";



            
          }
          else{
        $lot=Lot::findorfail($request->id);
        $lot->active =0;
        $lot->fin_lot=$request->fin_lot;
        $lot->save();
        $err = 1;
        return redirect()->route('lot.index',$err);


          }
           
       
      
        

    }

}
