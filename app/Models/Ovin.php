<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ovin extends Model
{
    use HasFactory;
    use softDeletes;
   // protected $fillable=['num','date_achat'];// pour permetre a create d'inserer les donné
    //protected $guarded =['sexe'];//pour ne pas inserer les donner dans la colone sexe
 public function scopeRecherche ($query,$num){
    return   $query ->where('num', $num)->first();
 }
 public function lot()
 {
   return $this->hasOne(Lot::class);
 }
}
