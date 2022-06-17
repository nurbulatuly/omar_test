<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vse producti iz TMTs
        $tmcProducts = DB::table('TMTs')
            ->where('OsnovnoyShtrikhKod','!=','')
            ->select('Naimenovanie','kod','Nomenklatura_UID_TMC','ddappBrendlayn')
            ->get();

        foreach ($tmcProducts as $tmcProduct){
            // Svyazannaya cena po TMTs
            $tmcPriceOfProduct = DB::table('TsenyTMTs')
                ->where('Nomenklatura_UID_TMC', $tmcProduct->Nomenklatura_UID_TMC)
                ->select('Tsena')
                ->first();
            $productVariantPrice = 0;
            if($tmcPriceOfProduct){
                $productVariantPrice = $tmcPriceOfProduct->Tsena;
            }
            //
            $product = Product::where('title',$tmcProduct->ddappBrendlayn)->first();
            $productVariant = ProductVariant::create([
                'name' => $tmcProduct->Naimenovanie,
                'sku' => $tmcProduct->kod,
                'price' => $productVariantPrice
            ]);
            if ($product){
                $productVariant->product()->associate($product);
                $productVariant->save();
            }
        }
    }
}
