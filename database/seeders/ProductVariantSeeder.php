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
        $tmcProducts = DB::table('TMTs')
            ->leftJoin('TsenyTMTs', function ($join){
                $join->on('TMTs.Nomenklatura_UID_TMC','=','TsenyTMTs.Nomenklatura_UID_TMC');
            })
            ->where('OsnovnoyShtrikhKod','!=','')
            ->get();

        $products = Product::all();
        foreach ($tmcProducts as $tmcProduct){
            //
            $product = $products->first(function ($item) use ($tmcProduct){
                return $item->title == $tmcProduct->ddappBrendlayn;
            });
            if ($product){
                $product->variants()->create([
                    'name' => $tmcProduct->Naimenovanie,
                    'sku' => $tmcProduct->Kod,
                    'foreign_uid' => $tmcProduct->Nomenklatura_UID_TMC,
                    'price' => $tmcProduct->Tsena,
                ]);
            }
        }
    }
}
