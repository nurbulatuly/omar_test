<?php

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


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
    dd('test');
});

//function productsTable()
//{
//    $tmts = DB::table('TMTs')->get();
//
//    foreach ($tmts as $tmt)
//    {
//
//        DB::table('products')->insert(
//            [
//                'title' => $tmt->NaimenovaniePolnoe,
//                'sku' => $tmt->OsnovnoyShtrikhKod,
//                'url_id' => $tmt->Nomenklatura_UID_TMC
//            ]
//        );
//    }
//}
//
//function pricesTable()
//{
//
//    $prices = DB::table('TsenyTMTs')->get();
//
//    foreach($prices as $price)
//    {
//        DB::table('prices')->insert(
//            [
//                'price' => $price->Tsena,
//                'product_url_id' => $price->Nomenklatura_UID_TMC
//            ]
//        );
//    }
//}
//
//function priceProductIDTable()
//{
//    $products = Product::all();
//    $prices = Price::all();
//
//    foreach ($prices as $price)
//    {
//        foreach ($products as $product)
//        {
//            if($price->product_url_id == $product->url_id)
//            {
//                $prices->product_id = $product->id;
//                $price->save();
//            }
//        }
//    }
//}
