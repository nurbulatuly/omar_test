<?php

use App\Models\Property;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Taxon;

/*
| Цена продукта
| TMTs -> Nomenklatura_UID_TMC = TsenyTMTs -> Nomenklatura_UID_TMC
|
| Единится измерения по берется по цене
| TsenyTMT -> Namenklatura_UID_TMC = Edinitsyizmerenya -> Vladelets_UID_Vladelec
|
*/

Route::get('/', function () {
    //


    $propertyValuesTmc = DB::table('EdinitsyIzmereniya')
        ->select('EdinitsaPoKlassifikatoru','Koeffitsient','Vladelets_UID_Vladelec')
        ->where('EdinitsaPoKlassifikatoru','!=','')
        ->get();
    dd( $propertyValuesTmc);
});
