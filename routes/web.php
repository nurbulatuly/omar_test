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


function categoryTable()
{
    $categories = DB::table('NomenklaturnyeGruppy')->get();

    foreach($categories as $category)
    {
        DB::table('categories')->insert(
            [
            'title' => $category->Naimenovanie,
            'url_id' => $categories->Ssylka_UID_Sylka,
            'parent_url_id' => $categories->Roditel_UID_Roditel
            ]
        );
    }
}

function categoryParentId(){
    $categories = Category::all();
    foreach($categories as $category)
    {
        if($category->parent_url_id)
        {
            $parent = Category::where('url_id','=',$category->parent_url_id)->first();
            $category->parent_id = $parent->id;
            $category->save();
        }
    }

}

function productsTable()
{
    $tmts = DB::table('TMTs')->get();

    foreach ($tmts as $tmt)
    {

        DB::table('products')->insert(
            [
                'title' => $tmt->NaimenovaniePolnoe,
                'sku' => $tmt->OsnovnoyShtrikhKod,
                'url_id' => $tmt->Nomenklatura_UID_TMC
            ]
        );
    }
}

function pricesTable()
{

    $prices = DB::table('TsenyTMTs')->get();

    foreach($prices as $price)
    {
        DB::table('prices')->insert(
            [
                'price' => $price->Tsena,
                'product_url_id' => $price->Nomenklatura_UID_TMC
            ]
        );
    }
}

function priceProductIDTable()
{
    $products = Product::all();
    $prices = Price::all();

    foreach ($prices as $price)
    {
        foreach ($products as $product)
        {
            if($price->product_url_id == $product->url_id)
            {
                $prices->product_id = $product->id;
                $price->save();
            }
        }
    }
}
