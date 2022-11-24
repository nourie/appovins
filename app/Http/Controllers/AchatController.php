<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use App\Models\Achat;
use App\Models\Avoir_achat;
use App\Models\Ovin;
use App\Models\Temp_achat;
use Illuminate\Pagination\Paginator;
use Carbon;

use function PHPUnit\Framework\returnSelf;

class AchatController extends Controller

{
    public function achat(Request $request)
    {

        return view('achat.achat');
    }
    public function addachat(Request $request)
    {

        $achat = new Achat();
        $achat->date_achat = $request->date_achat;
        $achat->nombre_achat = $request->nombre_achat;
        $achat->nb_male = $request->nb_male;
        $achat->nb_female = $request->nb_female;
        $achat->nb_angeau = $request->nb_angeau;
        $achat->id_vendeur = $request->vendeur;
        $achat->prix_achat = $request->prix_achat;
        $achat->updatable = 1;
        $achat->numerotable = 1;
        $achat->type = 0;
        $achat->save();
        return redirect('achat/');
    }
    public function edit($id)
    {
        // $ovin = Ovin::findorfail($id);
        $achat = Achat::where('id', $id)->first();
        return view('achat.edit', compact('achat'));
    }
    public function update(Request $request, $id)
    {
        $achat = Achat::findorFail($id);;
        $achat->date_achat = $request->date_achat;
        $achat->nombre_achat = $request->nombre_achat;
        $achat->nb_male = $request->nb_male;
        $achat->nb_female = $request->nb_female;
        $achat->nb_angeau = $request->nb_angeau;
        $achat->id_vendeur = $request->vendeur;
        $achat->prix_achat = $request->prix_achat;
        $achat->updatable = 0;

        $achat->save();
        return redirect('achat/');
    }
    public function numerotation(request $request)
    {
        $nb = (int)$request->nb_male + (int) $request->nb_female;
        $n = explode(PHP_EOL, $request->text);
        $tab = array();
        for ($i = 0; $i < count($n); $i++) {


            if (str_contains($n[$i], '-')) {
                $nn = explode('-', $n[$i]);
                for ($j = $nn[0]; $j <= $nn[1]; $j++) {

                    $tab[] = (int) $j;
                }
            } else {
                $tab[] = (int) $n[$i];
            }
        }
        $tabovin3[] = null;
        $ovins = Ovin::get('num');
        foreach ($ovins as $ovin) {
            $tabovin3[] = (int)$ovin->num;
        }
        if (isset($tabovin3)) {
            sort($tabovin3);
        }

        sort($tab);
        $tab2 = array_diff_key($tab, array_unique($tab));
        if (count($tab2) > 0) {
            return $tab2;
        } else {
            if (count($tab) == $nb) {
                $tab4 = array_intersect($tabovin3, $tab);
                if (count($tab4) > 0) {
                    return ("ces numeros existent deja ") . print_r($tab4);
                } else {
                    echo "numerotation en cours plz wait";
                    ///////////////////////////
                    $sexmale = $request->nb_male;

                    for ($i = 0; $i < $nb; $i++) {

                        $ovin = new Ovin();
                        $ovin->num = $tab[$i];
                        $ovin->taged = true;
                        $ovin->date_achat = $request->date_achat;
                        $ovin->id_achat = $request->id;

                        if ($sexmale > 0) {
                            $ovin->sexe = true;
                        } else {
                            $ovin->sexe = false;
                        }
                        $sexmale--;

                        $ovin->alive = true;
                        $ovin->vendu = false;
                        $ovin->id_mere = 0;
                        $ovin->id_source = 1; // Achat
                        $ovin->save();
                    }
                    $achats = Achat::where('id', $request->id)->get()->first();
                    $achats->numerotable = 0;
                    $achats->updatable = 0;
                    $achats->save();
                    return redirect('achat/');

                    //////////////////////
                }
            } else {
                if (($nb - count($tab)) > 0) {
                    return "تأكد من العدد يجب إضافة" . ($nb - count($tab));
                } else {
                    return "تأكد من العدد يجب إنقاص" . (-$nb + count($tab));
                }
            }
        }
    }
    public function anumeroter($id)
    {
        $achats = Achat::findOrFail($id);
        return view('achat.numerotation', compact('achats'));
    }
    public function index()
    {
        $achats = Achat::where('type', 0)->orderByDesc('achats.date_achat')
            ->paginate(10);
            $titre='الشراء';
            $date='الشراء';


        return view('achat.index', compact('achats','date','titre'));
    }
    public function indexavoir()
    {
        $achats = Achat::where('type', 1)->orderByDesc('achats.date_achat')
            ->paginate(10);
            $titre='الإعادات';
            $date='الإعادة';
        return view('achat.index', compact('achats','date','titre'));
    }
    public function avoir()
    {
        ////////////////////
        $temps = Temp_achat::get();
        $total = Temp_achat::sum('prix_retour');
        $error = "أدخل الرقم ";
        $nombres = Temp_achat::count();
        $nombremale = Temp_achat::where('taged', '1')
            ->where('sexe', '1')->count();
        $nombrefemale = Temp_achat::where('taged', '1')
            ->where('sexe', '0')->count();
        $nombreagneaux = Temp_achat::where('taged', '0')
            ->count();
        // return $nombremale;

        return view('achat/avoirachat', compact('temps', 'total', 'error', 'nombres', 'nombremale', 'nombrefemale', 'nombreagneaux'));
        /////////////////////////
        $achats = Achat::orderByDesc('achats.date_achat')
            ->paginate(10);
        $temps = $achats;

        //  return view('achat.avoirachat', compact('achats','temps'n'error,));
        //   return $achats;

    }
    public function search(request $request)
    {
        //////////////////////////////////////////////
        $request->validate([
            'num' => 'required|unique:temp_achats'
        ]);

        $temps = Temp_achat::get();


        if (count($temps) > 0) {
            $ovins =  DB::table('achats')
                ->join('users', 'users.id', '=', 'achats.id_vendeur')
                ->join('ovins', 'ovins.id_achat', '=', 'achats.id')
                ->where('ovins.num', $request->num)
                ->where('ovins.alive', 1)
                ->where('ovins.vendu', 0)
                ->where('id_achat', $temps[0]->id_achat)
                ->first();
        } else {
            $ovins =  DB::table('achats')
                ->join('users', 'users.id', '=', 'achats.id_vendeur')
                ->join('ovins', 'ovins.id_achat', '=', 'achats.id')
                ->where('ovins.num', $request->num)
                ->where('ovins.alive', 1)
                ->where('ovins.vendu', 0)
                ->first();
        }

        //////////////////////


        // return $ovins;
        ///////////////////////

        if (isset($ovins)) {
            $temps = new Temp_achat();
            $temps->id_ovin = $ovins->id;
            $temps->num = $ovins->num;
            $temps->taged = $ovins->taged;
            $temps->date_achat = $ovins->date_achat;
            $temps->date_naissance = $ovins->date_naissance;
            $temps->sexe = $ovins->sexe;
            $temps->date_retour = $request->date_retour;
            $temps->prix_retour = $request->prix_retour;
            $temps->id_achat = $ovins->id_achat;
            $temps->nombre_retour = 1;
            $temps->nb_male = 1;
            $temps->nb_female = 1;
            $temps->nb_angeau = 1;
            $temps->id_vendeur =  $ovins->id_vendeur;
            $temps->name_vendeur = $ovins->name;
            $temps->saved = 0;
            $temps->save();
            $error = " إضافة رقم آخر";
        } else {
            $total = Temp_achat::sum('prix_retour');
            $temps = Temp_achat::get();
            $error = "الرقم غير موجود ";
            $nombres = Temp_achat::count();
            $nombremale = Temp_achat::where('taged', '1')
                ->where('sexe', '1')->count();
            $nombrefemale = Temp_achat::where('taged', '1')
                ->where('sexe', '0')->count();
            $nombreagneaux = Temp_achat::where('taged', '0')
                ->count();
            // return $nombremale;

            return view('achat/avoirachat', compact('temps', 'total', 'error', 'nombres', 'nombremale', 'nombrefemale', 'nombreagneaux'));
        }

        $total = Temp_achat::sum('prix_retour');
        $temps = Temp_achat::get();
        $nombres = Temp_achat::count();
        $nombremale = Temp_achat::where('taged', '1')
            ->where('sexe', '1')->count();
        $nombrefemale = Temp_achat::where('taged', '1')
            ->where('sexe', '0')->count();
        $nombreagneaux = Temp_achat::where('taged', '0')
            ->count();
        // return $nombremale;

        return view('achat/avoirachat', compact(
            'temps',
            'total',
            'error',
            'nombres',
            'nombremale',
            'nombrefemale',
            'nombreagneaux'
        ));
        /////////////////////////////////////////////

    }
    public function valider()
    {
        $temps = Temp_achat::get();

        if (count($temps) > 0) {
            $total = Temp_achat::sum('prix_retour');
            $temps = Temp_achat::get();
            $nombres = Temp_achat::count();
            $nombremale = Temp_achat::where('taged', '1')
                ->where('sexe', '1')->count();
            $nombrefemale = Temp_achat::where('taged', '1')
                ->where('sexe', '0')->count();
            $nombreagneaux = Temp_achat::where('taged', '0')
                ->count();


            $achats = new Achat();
            $achats->date_achat = $temps[0]->date_retour;
            $achats->nombre_achat = $nombres;
            $achats->nb_male = $nombremale;
            $achats->nb_female = $nombrefemale;
            $achats->nb_angeau = $nombreagneaux;
            $achats->id_vendeur = $temps[0]->id_vendeur;
            $achats->prix_achat = $total;
            $achats->updatable = 0;
            $achats->type = 1;
            $achats->numerotable = 0;

            $achats->save();

            foreach ($temps as $temp) {
                $avoirachat = new Avoir_achat();
                $avoirachat->id_achat = $achats->id;
                $avoirachat->id_ovin = $temp->id_ovin;
                $avoirachat->prix_achat = $temp->prix_retour;
                $avoirachat->save();
                $ovins = Ovin::findorfail($temp->id_ovin);
                $ovins->vendu = 2;
                $ovins->save();
            }

            Temp_achat::truncate();
        }
        return redirect()->route('achat.indexavoir', 1);
    }
}
