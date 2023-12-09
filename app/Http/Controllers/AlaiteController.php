<?php

namespace App\Http\Controllers;

use App\Models\Alaite;
use App\Models\Ovin;
use App\Models\Temp_vente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lot;
use App\Models\ColorLot;
use App\Models\Ovin_Lot;
use Illuminate\Support\Facades\DB;



class AlaiteController extends Controller
{
    public function show ()
    {
        $temps = Temp_vente::get();
        $erroral = "أدخل رقم المرضعة ";
        $errorme = "أدخل رقم الأم ";
        $petits =array();
        $nummere='';
        $numali="";


        return view('alaiter.alaite',compact('erroral','errorme','nummere','petits','numali'));

    }
    public function search (Request $request)
    {
        
        $nummere=$request->nummere;
        $numali=$request->numali;

     if ($request->numali ==$request->nummere) 
        {
          echo "رقم المرضع و الأم نفسه"   ;     
        }
          else 
        {

    $idal=Ovin::where('num',$request->numali)
    ->where ('sexe',false)
    ->where('alive',true)
    ->first();

  //  echo ($idal);
    $erroral = "أدخل رقم المرضعة ";
    $errorme = "أدخل رقم الأم ";
    $ang= array();
    $id=Ovin::where('num',$request->nummere)
    ->first();
    

  //  dd ($->count());
    if ((is_null($idal)))
    { 
        $erroral=" رقم المرضع خاطىء";
        return "رقم الأم خاطئ";

    }

      if (is_null($id))
      {
        $errorme="رقم الأم خاطئ";
        return "رقم الأم خاطئ";
      }
      else 
       {
        $petits=Ovin::join ('ovin__lots','id_ovin','ovins.id')
        ->join('lots','lots.id','ovin__lots.id_lot')
        ->join('color_lots','color_lots.id','lots.color_id')
        ->where('id_mere',$id->id)
        ->where('date_naissance','>',Carbon::now()->subDays(20)) //  dans le future un parametre pour regler l'age max de l'alaitement You also have whereMonth / whereDay / whereYear / whereTime


        ->orderBy('date_naissance','desc')
        ->Paginate(5);
       // $now = date('Y-m-d');
        $i=0;
        
        foreach( $petits as $petit)
        {
            // $ageday = (strtotime($now) - strtotime($petit->date_naissance)) / 86400; //(60 * 60 * 24))= age on jours;
            // if( $ageday <= 30 ) 
            // {
                 $ang[$i]=$petit;
                 $al=Alaite::where('id_petit',$ang[$i]->id_ovin)->first();
                 if (is_null($al))
                 {
                    $ang[$i]->checked='';
                    
                 } 
                 else
                 {
                    $ang[$i]->checked='checked';  
                 }
                 $i++;
                

            // }


        }
     
    }
    
    
    $petits=$ang;
    return view('alaiter.alaite',compact('erroral','petits','nummere','numali','errorme'));



  }

        
        
        
        
        
      

    }
    public function searchal (Request $request)
    {
        $id=Ovin::where('num',$request->num)
        ->first();
        $error = "أدخل رقم المرضعة ";
        $now = date('Y-m-d');
        $i=0;
        $ang= array();
        $nummere=$request->num;

        return view('alaiter.alaite',compact('error','nummere'));
    


    }
    public function alaiter (Request $request)
    {
      return $request;
    }

    public function ajaxRequest(Request $request)
{
    // Process the request data
    $data = $request->all();
    
    // Perform necessary operations
    
    // Return a JSON response
    return response()->json(['success' => true, 'data' => $data]);
}
}
