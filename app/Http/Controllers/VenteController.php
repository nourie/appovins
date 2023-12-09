<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Ovin;
use App\Models\Lot;
use App\Models\Ovin_Lot;
use App\Models\Temp_vente;
use App\Models\ListeVente;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;



use function PHPUnit\Framework\isNull;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $temps = Temp_vente::get();
        $total = Temp_vente::sum('prix_vente');
        $error = "أدخل الرقم ";
        $nombres = Temp_vente::count();
        $nombremale = Temp_vente::where('taged', '1')
            ->where('sexe', '1')->count();
        $nombrefemale = Temp_vente::where('taged', '1')
            ->where('sexe', '0')->count();
        $nombreagneaux = Temp_vente::where('taged', '0')
            ->count();
        // return $nombremale;

        return view('ventes/vente', compact('temps', 'total', 'error', 'nombres', 'nombremale', 'nombrefemale', 'nombreagneaux'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function ventemasse()
    {
        $ovins = Ovin::query()
        ->where('sexe','0')
        ->where('alive', '1')
        ->where('vendu', '0')
        ->where('taged','0')
        ->where('date_naissance','<','2023-01-04')
        ->get();

        // $i=0;
        // for  ($i=0; $i< 12;$i++ )
        // {
           
        //         $temps = new Temp_vente();
        //         $temps->id_ovin = $ovins[$i]->id;
        //         $temps->num = $ovins[$i]->num;
        //         $temps->taged = $ovins[$i]->taged;
        //         $temps->date_achat = $ovins[$i]->date_achat;
        //         $temps->date_naissance = $ovins[$i]->date_naissance;
        //         $temps->sexe = $ovins[$i]->sexe;
        //         $temps->date_vente = '2023-06-28';
        //         $temps->prix_vente = 0;
        //         $temps->nombre_vente = 1;
        //         $temps->nb_male = 1;
        //         $temps->nb_female = 1;
        //         $temps->nb_angeau = 1;
        //         $temps->id_acheteur = 20;
        //         $temps->name_acheteur = 1;
        //         $temps->saved = 0;
        //         $temps->save();
        //         $error = " إضافة رقم آخر";

        // }
        return $ovins->count();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        $ventes =  DB::table('ventes')
            ->join('users', 'users.id', '=', 'ventes.id_acheteur')
            ->orderByDesc('ventes.date_vente')
            ->paginate(10);
        return view('ventes.index', compact('ventes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function edit(Vente $vente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vente $vente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vente  $vente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vente $vent)
    {
        return $vent;
         //Ovin::destroy($id);
    }
    public function search(Request $request)

    {

        $request->validate([
            'num' => 'required|unique:temp_ventes'
        ]);
        // $ovins = Ovin::query()
        //     ->where('num', $request->num)->where('alive', '1')->where('vendu', '0')
        //     ->first();
          $ovins = Ovin::query()
            ->where('num', $request->num)->where('die_status','>','0')->where('vendu', '0')
            ->first();  // ajouter les ovins égorgé en plus des en vie a la vente

        if (isset($ovins)) {
            $temps = new Temp_vente();
            $temps->id_ovin = $ovins->id;
            $temps->num = $ovins->num;
            $temps->taged = $ovins->taged;
            $temps->date_achat = $ovins->date_achat;
            $temps->date_naissance = $ovins->date_naissance;
            $temps->sexe = $ovins->sexe;
            $temps->date_vente = $request->date_vente;
            $temps->prix_vente = $request->prix_vente;
            $temps->nombre_vente = 1;
            $temps->nb_male = 1;
            $temps->nb_female = 1;
            $temps->nb_angeau = 1;
            $temps->id_acheteur =  $request->id_acheteur;
            $temps->name_acheteur = 1;
            $temps->saved = 0;
            $temps->save();
            $error = " إضافة رقم آخر";
        } else {
            $total = Temp_vente::sum('prix_vente');
            $temps = Temp_vente::get();
            $error = "الرقم غير موجود ";
            $nombres = Temp_vente::count();
            $nombremale = Temp_vente::where('taged', '1')
                ->where('sexe', '1')->count();
            $nombrefemale = Temp_vente::where('taged', '1')
                ->where('sexe', '0')->count();
            $nombreagneaux = Temp_vente::where('taged', '0')
                ->count();
            // return $nombremale;

            return view('ventes/vente', compact('temps', 'total', 'error', 'nombres', 'nombremale', 'nombrefemale', 'nombreagneaux'));
        }

        $total = Temp_vente::sum('prix_vente');
        $temps = Temp_vente::get();
        $nombres = Temp_vente::count();
        $nombremale = Temp_vente::where('taged', '1')
            ->where('sexe', '1')->count();
        $nombrefemale = Temp_vente::where('taged', '1')
            ->where('sexe', '0')->count();
        $nombreagneaux = Temp_vente::where('taged', '0')
            ->count();
        // return $nombremale;

        return view('ventes/vente', compact(
            'temps',
            'total',
            'error',
            'nombres',
            'nombremale',
            'nombrefemale',
            'nombreagneaux'
        ));
    }
    public function valider()
    {
        $temps = Temp_vente::get();

        if (count($temps) > 0)
            $total = Temp_vente::sum('prix_vente');
        $temps = Temp_vente::get();
        $nombres = Temp_vente::count();
        $nombremale = Temp_vente::where('taged', '1')
            ->where('sexe', '1')->count();
        $nombrefemale = Temp_vente::where('taged', '1')
            ->where('sexe', '0')->count();
        $nombreagneaux = Temp_vente::where('taged', '0')
            ->count(); {

            $ventes = new Vente();
            $ventes->date_vente = $temps[0]->date_vente;
            $ventes->nombre_vente = $nombres;
            $ventes->nb_male = $nombremale;
            $ventes->nb_female = $nombrefemale;
            $ventes->nb_angeau = $nombreagneaux;
            $ventes->id_acheteur = $temps[0]->id_acheteur;
            $ventes->prix_vente = $total;
            $ventes->updatable = 0;
            $ventes->save();




            
            foreach ($temps as $temp) {
                $listeVentes = new ListeVente();
                $listeVentes->id_vente = $ventes->id;
                $listeVentes->id_ovin = $temp->id_ovin;
                $listeVentes->prix_vente = $temp->prix_vente;
                $listeVentes->save();
                $ovins = Ovin::findorfail($temp->id_ovin);
                if ($ovins->die_status == 1 )
                {
                   
                    $ovins->vendu = 3;
                }
                else{ 
                    $ovins->vendu = 1; 
                }
               
                
                $ovins->save();
               // ****** to reprograme as event in the future
               $Ovin_lot = Ovin_Lot::where('id_ovin', '=', $temp->id_ovin)->get();
               if ($Ovin_lot->count()>0)
               {
                   $Ovin_lot = Ovin_Lot::where('id_ovin', '=', $temp->id_ovin)->first();
       
                   $lot = Lot::where('id', $Ovin_lot->id_lot)->first();
                   
                   
                   $Ovin_lot->delete();
                   $nbr=Ovin_Lot::where('id_lot','=',$lot->id)->count();
                   $lot->nbr_ovins = $nbr;
                   $lot->save();
                   
               }
                //*****
            }

            Temp_vente::truncate();
        }
        return redirect()->route('vente.show', 1);
    }
}
