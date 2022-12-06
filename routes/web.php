<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\OvinController;
use App\Http\Controllers\AchatController;
use App\Http\Controllers\AvorterController;
use App\Http\Controllers\NaissanceController;
use App\Http\Controllers\VenteController;
use App\Models\Naissance;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['userrole'])->group(function () {
    Route::get('/achat/achat', [AchatController::class, 'achat'])->name('achat.achat');
    Route::get('/achat/addachat', [AchatController::class, 'addachat'])->name('achat.addachat');
    Route::get('/achat/avoir', [AchatController::class, 'avoir'])->name('achat.avoir');
    Route::get('/achat/search', [AchatController::class, 'search'])->name('achat.search');
    Route::get('/achat/valider/', [AchatController::class, 'valider'])->name('achat.valider');
    Route::get('/ovins/agneaulst', [OvinController::class, 'show_agneau'])->name('ovins.agneaulist');
Route::put('/ovins/mort/{id}', [OvinController::class, 'adddie'])->name('ovins.adddie');
Route::get('/die/', [OvinController::class, 'dieindex'])->name('die.index');
Route::get('/agneauxmort/', [OvinController::class, 'dieindex2'])->name('die.index2');

Route::get('/bin/', [OvinController::class, 'showbin'])->name('ovins.bin');









Route::get('/achat/numerotation/', [AchatController::class, 'numerotation'])->name('achat.numerotation');
Route::get('/achat/anumeroter/{id}', [AchatController::class, 'anumeroter'])->name('achat.anumeroter');
Route::get('/achat/edit/{id}', [AchatController::class, 'edit'])->name('achat.edit');
Route::put('/achat/update/{id}', [AchatController::class, 'update'])->name('achat.update');
Route::get('/achat/', [AchatController::class, 'index'])->name('achat.index');
Route::get('/achat/indexavoir', [AchatController::class, 'indexavoir'])->name('achat.indexavoir');

Route::get('/naissance/', [NaissanceController::class, 'index'])->name('naissance.index');
Route::get('/avorter/', [AvorterController::class, 'index'])->name('avorter.index');

Route::get('vente/search', [VenteController::class, 'search'])->name('vente.search');
Route::get('vente/valider', [VenteController::class, 'valider'])->name('vente.valider');

Route::resource('vente', VenteController::class,['names'=>['index'=>'vente.index','show'=>'vente.show']]);



Route::resource('ovins', OvinController::class);
Route::get('/ovins/naissance/{id}', [OvinController::class, 'naissance'])->name('ovins.naissance');
Route::get('/ovins/avorter/{id}', [OvinController::class, 'avorter'])->name('ovins.avorter');
Route::get('/ovins/restore/{id}',[OvinController::class,'restore']);
Route::get('/ovins/forcedelete/{id}',[OvinController::class,'forcedelete'])->name('ovins.fdelete');
Route::get('/ovins/find/',[OvinController::class,'find'])->name('ovins.find');
Route::get('/search', [OvinController::class, 'search'])->name('ovins.search');
Route::get('/ovins/addnaissance/{id}', [OvinController::class, 'addnaissance'])->name('ovins.addnaissance');
Route::get('/ovins/addavorter/{id}', [OvinController::class, 'addavorter'])->name('ovins.addavorter');
Route::get('/ovins/details/{id}', [OvinController::class, 'details'])->name('ovins.details');





});
