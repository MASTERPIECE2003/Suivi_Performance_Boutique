<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\boutiquecontroller;
use App\Http\Controllers\registrecontroller;
use App\Http\Controllers\excelcontroller;
use App\Http\Controllers\EmailTestController;
use App\Http\Controllers\ObjectifRealisationController;
use Carbon\Carbon;
Route::get('/boutique/suppr/{id}', [boutiquecontroller::class,'suppr' ])->name('boutique.suppr');
Route::get('/boutique/ajouter', [boutiquecontroller::class,'ajouter' ])->name('boutique.ajouter');
Route::get('/ajouter/store',[boutiquecontroller::class, 'store']);
Route::post('/modifier/update/{id_vente}',[boutiquecontroller::class, 'update'])->name('modifier.update');
Route::get('/search',[boutiquecontroller::class,'search' ])->name('liste.search');
Route::get('/boutique/modifier/{id}', [boutiquecontroller::class,'modifier' ])->name('boutique.modifier'); 
Route::get('/boutique/recap', [boutiquecontroller::class, 'recap'])->name('boutique.recap');
Route::group(['middleware'=>'guest'],function(){
Route::get('/login/login',[registrecontroller::class,'login' ])->name('login.login');
Route::get('/login/register',[registrecontroller::class,'register' ])->name('login.register');
Route::get('/login/mdpoublie',[registrecontroller::class,'mdpoublie' ])->name('login.mdpoublie');
Route::get('/login/nouveau',[registrecontroller::class,'nouveau' ])->name('login.nouveau');
Route::get('/login/oubli',[registrecontroller::class,'oubli' ])->name('login.oubli');
Route::get('/login/term', [registrecontroller::class, 'term'])->name('login.term');
Route::get('/login/privacy', [registrecontroller::class, 'privacy'])->name('login.privacy');
Route::get('/register/registerPost',[registrecontroller::class,'registerPost' ]);
Route::get('/login/oubliPost',[registrecontroller::class,'oublPost' ]);
Route::get('/login/npost',[registrecontroller::class,'npost' ]);
Route::get('/register/mdpoubliePost',[registrecontroller::class,'mdpoubliePost' ]);
Route::get('/login/loginPost',[registrecontroller::class,'loginPost' ]);
});

Route::group(['middleware'=>'auth'],function(){
Route::get('/boutique/tbl', [boutiquecontroller::class, 'tbl'])->name('boutique.tbl');
Route::get('/boutique/liste/{jour?}/{semaine?}', [boutiquecontroller::class, 'liste'])->name('boutique.liste');
Route::delete('/logout',[registrecontroller::class,'logout'])->name('logout');});
Route::post('/import-excel', [excelcontroller::class, 'importExcel'])->name('import.excel');
Route::get('/export-excel/', [excelcontroller::class, 'exportExcel'])->name('export.excel');
Route::get('/obtenir', [ObjectifRealisationController::class, 'ObjectifsEtRealisations']);
Route::get('/exportrecap-excel/', [excelcontroller::class, 'exportrecap'])->name('exportrecap.excel');
