<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temp_vente;


class Temp_venteController extends Controller
{
    public function delete($id)
    {
        Temp_vente::destroy($id);
        return redirect()->route('vente.index', 1);

    }
}
